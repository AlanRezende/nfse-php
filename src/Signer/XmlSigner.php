<?php

namespace Nfse\Signer;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;
use Exception;

class XmlSigner implements SignerInterface
{
    private Certificate $certificate;
    private const CANONICAL = [true, false, null, null];

    public function __construct(Certificate $certificate)
    {
        $this->certificate = $certificate;
    }

    public function sign(string $xmlContent, string $tagToSign): string
    {
        if (empty($xmlContent)) {
            throw new Exception("Conteúdo XML vazio.");
        }

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = false;
        $dom->loadXML($xmlContent);

        $root = $dom->documentElement;
        $node = $dom->getElementsByTagName($tagToSign)->item(0);

        if (empty($node)) {
            throw new Exception("Tag {$tagToSign} não encontrada para assinatura.");
        }

        // Check if already signed (optional, but good practice)
        // For now, we assume we are signing a fresh document or adding a signature.
        
        $this->createSignature(
            $dom,
            $root,
            $node
        );

        return $dom->saveXML($dom->documentElement, LIBXML_NOXMLDECL);
    }

    private function createSignature(
        DOMDocument $dom,
        DOMNode $root,
        DOMElement $node,
        int $algorithm = OPENSSL_ALGO_SHA1
    ): void {
        $nsDSIG = 'http://www.w3.org/2000/09/xmldsig#';
        $nsCannonMethod = 'http://www.w3.org/TR/2001/REC-xml-c14n-20010315';
        $nsSignatureMethod = 'http://www.w3.org/2000/09/xmldsig#rsa-sha1';
        $nsDigestMethod = 'http://www.w3.org/2000/09/xmldsig#sha1';
        $digestAlgorithm = 'sha1';

        if ($algorithm == OPENSSL_ALGO_SHA256) {
            $digestAlgorithm = 'sha256';
            $nsSignatureMethod = 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha256';
            $nsDigestMethod = 'http://www.w3.org/2001/04/xmlenc#sha256';
        }

        $nsTransformMethod1 = 'http://www.w3.org/2000/09/xmldsig#enveloped-signature';
        $nsTransformMethod2 = 'http://www.w3.org/TR/2001/REC-xml-c14n-20010315';

        // Get ID attribute
        $idSigned = $node->getAttribute('Id');
        if (empty($idSigned)) {
             throw new Exception("Tag a ser assinada deve possuir um atributo 'Id'.");
        }

        // Calculate Digest
        $digestValue = $this->makeDigest($node, $digestAlgorithm);

        // Create Signature Node
        $signatureNode = $dom->createElementNS($nsDSIG, 'Signature');
        // Append to parent of the node being signed, or root? 
        // In NFSe, usually it's a sibling of infDPS (child of DPS) or child of NFSe.
        // The provided example code appends to $root. 
        // In our case, if we sign 'infDPS', the parent is 'DPS'. We should append to 'DPS'.
        $node->parentNode->appendChild($signatureNode);

        $signedInfoNode = $dom->createElement('SignedInfo');
        $signatureNode->appendChild($signedInfoNode);

        // CanonicalizationMethod
        $canonicalNode = $dom->createElement('CanonicalizationMethod');
        $signedInfoNode->appendChild($canonicalNode);
        $canonicalNode->setAttribute('Algorithm', $nsCannonMethod);

        // SignatureMethod
        $signatureMethodNode = $dom->createElement('SignatureMethod');
        $signedInfoNode->appendChild($signatureMethodNode);
        $signatureMethodNode->setAttribute('Algorithm', $nsSignatureMethod);

        // Reference
        $referenceNode = $dom->createElement('Reference');
        $signedInfoNode->appendChild($referenceNode);
        $referenceNode->setAttribute('URI', "#$idSigned");

        // Transforms
        $transformsNode = $dom->createElement('Transforms');
        $referenceNode->appendChild($transformsNode);

        $transfNode1 = $dom->createElement('Transform');
        $transformsNode->appendChild($transfNode1);
        $transfNode1->setAttribute('Algorithm', $nsTransformMethod1);

        $transfNode2 = $dom->createElement('Transform');
        $transformsNode->appendChild($transfNode2);
        $transfNode2->setAttribute('Algorithm', $nsTransformMethod2);

        // DigestMethod
        $digestMethodNode = $dom->createElement('DigestMethod');
        $referenceNode->appendChild($digestMethodNode);
        $digestMethodNode->setAttribute('Algorithm', $nsDigestMethod);

        // DigestValue
        $digestValueNode = $dom->createElement('DigestValue');
        $digestValueNode->appendChild($dom->createTextNode($digestValue));
        $referenceNode->appendChild($digestValueNode);

        // Calculate Signature
        $c14n = $this->canonize($signedInfoNode);
        $signature = $this->certificate->sign($c14n, $algorithm);
        $signatureValue = base64_encode($signature);

        // SignatureValue
        $signatureValueNode = $dom->createElement('SignatureValue');
        $signatureValueNode->appendChild($dom->createTextNode($signatureValue));
        $signatureNode->appendChild($signatureValueNode);

        // KeyInfo
        $keyInfoNode = $dom->createElement('KeyInfo');
        $signatureNode->appendChild($keyInfoNode);

        $x509DataNode = $dom->createElement('X509Data');
        $keyInfoNode->appendChild($x509DataNode);

        $pubKeyClean = $this->certificate->getCleanCertificate();
        $x509CertificateNode = $dom->createElement('X509Certificate');
        $x509CertificateNode->appendChild($dom->createTextNode($pubKeyClean));
        $x509DataNode->appendChild($x509CertificateNode);
    }

    private function makeDigest(DOMNode $node, string $algorithm): string
    {
        $c14n = $this->canonize($node);
        $hashValue = hash($algorithm, $c14n, true);
        return base64_encode($hashValue);
    }

    private function canonize(DOMNode $node): string
    {
        return $node->C14N(
            self::CANONICAL[0],
            self::CANONICAL[1],
            self::CANONICAL[2],
            self::CANONICAL[3]
        );
    }
}
