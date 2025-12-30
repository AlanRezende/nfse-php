<?php

namespace Nfse\Signer;

interface SignerInterface
{
    /**
     * Assina o conteúdo XML.
     *
     * @param string $xmlContent Conteúdo XML a ser assinado.
     * @param string $tagToSign Nome da tag que será assinada (ex: infDPS, infNFSe).
     * @return string XML assinado.
     */
    public function sign(string $xmlContent, string $tagToSign): string;
}
