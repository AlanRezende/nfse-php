import type { ReactNode } from "react";
import clsx from "clsx";
import Link from "@docusaurus/Link";
import useDocusaurusContext from "@docusaurus/useDocusaurusContext";
import Layout from "@theme/Layout";
import HomepageFeatures from "@site/src/components/HomepageFeatures";
import DtoAdvantages from "@site/src/components/DtoAdvantages";
import RoadmapStepper from "@site/src/components/RoadmapStepper";
import FAQ from "@site/src/components/FAQ";
import Heading from "@theme/Heading";
import Tabs from "@theme/Tabs";
import TabItem from "@theme/TabItem";

import styles from "./index.module.css";

import CodeBlock from "@theme/CodeBlock";

function HomepageHeader() {
    const { siteConfig } = useDocusaurusContext();
    return (
        <header className={clsx("hero hero--primary", styles.heroBanner)}>
            <div className={styles.heroContainer}>
                <div>
                    <Heading as="h1" className="hero__title">
                        {siteConfig.title}
                    </Heading>
                    <p className="hero__subtitle">{siteConfig.tagline}</p>
                    <p className={styles.heroDescription}>
                        Este pacote fornece um conjunto robusto de DTOs que
                        simplificam a criação e validação dos XMLs, oferecendo
                        uma interface fluida e uma documentação alinhada à
                        realidade do desenvolvedor.
                    </p>
                    <div className={styles.buttons}>
                        <Link
                            className="button button--secondary button--lg"
                            to="/docs/overview"
                        >
                            Começar Agora 🚀
                        </Link>
                    </div>
                </div>
                <div className={styles.codeBlockContainer}>
                    <div className={styles.codeHeader}>
                        <span
                            className={clsx(styles.dot, styles.dotRed)}
                        ></span>
                        <span
                            className={clsx(styles.dot, styles.dotYellow)}
                        ></span>
                        <span
                            className={clsx(styles.dot, styles.dotGreen)}
                        ></span>
                    </div>
                    <div className={styles.codeScroll}>
                        <Tabs>
                            <TabItem
                                value="array"
                                label="Array (Padrão Nacional)"
                                default
                            >
                                <CodeBlock language="php">
                                    {`use Nfse\\Dto\\DpsData;
use Nfse\\Xml\\DpsXmlBuilder;
use Illuminate\\Validation\\ValidationException;

// 1. Dados vindos da sua aplicação (ex: $request->all())
$dadosDoFormulario = [
    'versao' => '1.00',
    'infDPS' => [
        '@Id' => 'DPS123456',
        'tpAmb' => 2, // Homologação
        'dhEmi' => '2023-10-27T10:00:00',
        'verAplic' => '1.0',
        'serie' => '1',
        'nDPS' => '100',
        'dCompet' => '2023-10-27',
        'tpEmit' => 1,
        'cLocEmi' => '3550308',
        'prest' => [
            'CNPJ' => '12345678000199',
            'IM' => '12345',
            'xNome' => 'Minha Empresa Ltda'
        ],
        'toma' => [
            'CPF' => '11122233344',
            'xNome' => 'Cliente Exemplo'
        ],
        'serv' => [
            'cServ' => [
                'cTribNac' => '01.01',
                'xDescServ' => 'Desenvolvimento de Software'
            ]
        ],
        'valores' => [
            'vServPrest' => [
                'vServ' => 1000.00
            ],
            'trib' => [
                'tribMun' => [
                    'tribISSQN' => 1,
                    'tpRetISSQN' => 1
                ]
            ]
        ]
    ]
];

try {
    // 2. Validar e criar o DTO
    $dps = DpsData::validateAndCreate($dadosDoFormulario);

    // 3. Gerar o XML
    $builder = new DpsXmlBuilder();
    $xml = $builder->build($dps);

    // 4. Resultado
    header('Content-Type: application/xml');
    echo $xml;

} catch (ValidationException $e) {
    print_r($e->errors());
}`}
                                </CodeBlock>
                            </TabItem>
                            <TabItem
                                value="array-semantic"
                                label="Array (Semântico)"
                            >
                                <CodeBlock language="php">
                                    {`use Nfse\\Dto\\DpsData;
use Nfse\\Xml\\DpsXmlBuilder;

// Você também pode usar arrays com chaves legíveis
// O pacote entende tanto o padrão nacional quanto nomes amigáveis
$dados = [
    'versao' => '1.00',
    'infDps' => [
        'id' => 'DPS123456',
        'tipoAmbiente' => 2, // Homologação
        'dataEmissao' => '2023-10-27T10:00:00',
        'versaoAplicativo' => '1.0',
        'serie' => '1',
        'numeroDps' => '100',
        'dataCompetencia' => '2023-10-27',
        'tipoEmitente' => 1,
        'codigoLocalEmissao' => '3550308',
        'prestador' => [
            'cnpj' => '12345678000199',
            'inscricaoMunicipal' => '12345'
        ],
        'tomador' => [
            'cpf' => '11122233344',
            'nome' => 'Cliente Exemplo'
        ],
        'servico' => [
            'codigoTributacaoNacional' => '01.01',
            'descricao' => 'Desenvolvimento de Software'
        ],
        'valores' => [
            'valorServicos' => 1000.00
        ]
    ]
];

$dps = DpsData::from($dados);
$xml = (new DpsXmlBuilder())->build($dps);
echo $xml;`}
                                </CodeBlock>
                            </TabItem>
                            <TabItem
                                value="semantic"
                                label="Objeto (Semântico)"
                            >
                                <CodeBlock language="php">
                                    {`use Nfse\\Dto\\DpsData;
use Nfse\\Dto\\InfDpsData;
use Nfse\\Dto\\PrestadorData;
use Nfse\\Dto\\TomadorData;
use Nfse\\Dto\\ServicoData;
use Nfse\\Dto\\ValoresData;
use Nfse\\Xml\\DpsXmlBuilder;

// Construção Semântica com Argumentos Nomeados (PHP 8+)
// Você sabe exatamente o que cada campo significa
$dps = new DpsData(
    versao: '1.00',
    infDps: new InfDpsData(
        id: 'DPS123456',
        tipoAmbiente: 2, // Homologação
        dataEmissao: '2023-10-27T10:00:00',
        versaoAplicativo: '1.0',
        serie: '1',
        numeroDps: '100',
        dataCompetencia: '2023-10-27',
        tipoEmitente: 1, // Prestador
        codigoLocalEmissao: '3550308',
        prestador: new PrestadorData(
            cnpj: '12345678000199',
            inscricaoMunicipal: '12345',
            nomeFantasia: 'Minha Empresa Ltda'
        ),
        tomador: new TomadorData(
            cpf: '11122233344',
            nome: 'Cliente Exemplo'
        ),
        servico: new ServicoData(
            codigoTributacaoNacional: '01.01',
            descricao: 'Desenvolvimento de Software'
        ),
        valores: new ValoresData(
            valorServicos: 1000.00,
            tributacaoMunicipal: [ // Exemplo simplificado
                'tribISSQN' => 1,
                'tpRetISSQN' => 1
            ]
        ),
        // Campos opcionais podem ser omitidos ou passados como null
        motivoEmissaoTomadorIntermediario: null,
        chaveNfseRejeitada: null,
        substituicao: null,
        intermediario: null
    )
);

// Gerar o XML
$builder = new DpsXmlBuilder();
$xml = $builder->build($dps);

echo $xml;`}
                                </CodeBlock>
                            </TabItem>
                        </Tabs>
                    </div>
                </div>
            </div>
        </header>
    );
}

import React, { useState, useEffect } from "react";

export default function Home(): ReactNode {
    const { siteConfig } = useDocusaurusContext();
    const [isVisible, setIsVisible] = useState(true);

    useEffect(() => {
        const bannerDismissed = localStorage.getItem("dev-banner-dismissed");
        if (bannerDismissed === "true") {
            setIsVisible(false);
        }
    }, []);

    const handleClose = () => {
        setIsVisible(false);
        localStorage.setItem("dev-banner-dismissed", "true");
    };

    return (
        <Layout
            title={siteConfig.title}
            description="Description will go into a meta tag in <head />"
        >
            <HomepageHeader />
            <main>
                <HomepageFeatures />
                <DtoAdvantages />
                <RoadmapStepper />
                <FAQ />
            </main>
            {isVisible && (
                <div className="devBanner">
                    <span className="devBanner__text">
                        🚧 Este projeto está em{" "}
                        <strong>desenvolvimento ativo</strong>. Algumas
                        funcionalidades podem estar incompletas ou sujeitas a
                        alterações.
                    </span>
                    <button
                        className="devBanner__close"
                        onClick={handleClose}
                        aria-label="Fechar"
                    >
                        &times;
                    </button>
                </div>
            )}
        </Layout>
    );
}
