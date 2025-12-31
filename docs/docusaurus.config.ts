import { themes as prismThemes } from "prism-react-renderer";
import type { Config } from "@docusaurus/types";
import type * as Preset from "@docusaurus/preset-classic";

const config: Config = {
    title: "NFS-e Nacional PHP",
    tagline:
        "A maneira mais moderna e eficiente de integrar PHP com a NFS-e Nacional.",
    favicon: "img/favicon.ico",

    url: "https://nfse-nacional.github.io",
    baseUrl: "/",

    organizationName: "nfse-nacional",
    projectName: "nfse-php",

    onBrokenLinks: "warn",
    markdown: {
        format: "mdx",
        mermaid: true,
        hooks: {
            onBrokenMarkdownLinks: "warn",
        },
    },

    i18n: {
        defaultLocale: "pt-BR",
        locales: ["pt-BR"],
    },

    presets: [
        [
            "classic",
            {
                docs: {
                    sidebarPath: "./sidebars.ts",
                    editUrl:
                        "https://github.com/nfse-nacional/nfse-php/tree/main/docs/",
                },
                blog: false,
                theme: {
                    customCss: "./src/css/custom.css",
                },
            } satisfies Preset.Options,
        ],
    ],

    plugins: [
        [
            require.resolve("@easyops-cn/docusaurus-search-local"),
            {
                // Configurações de indexação
                hashed: true,
                language: ["pt", "en"],
                indexDocs: true,
                indexBlog: false,
                indexPages: true,

                // Configurações de busca
                searchResultLimits: 8,
                searchResultContextMaxLength: 50,

                // Estilo Spotlight/Command Palette
                searchBarShortcut: true,
                searchBarShortcutHint: true,
                searchBarPosition: "left",

                // Melhorias de UX
                highlightSearchTermsOnTargetPage: true,
                explicitSearchResultPath: true,
            },
        ],
    ],

    themeConfig: {
        image: "img/docusaurus-social-card.jpg",
        navbar: {
            title: "NFSe PHP",
            logo: {
                alt: "NFSe PHP Logo",
                src: "img/logo.svg",
            },
            items: [
                {
                    type: "docSidebar",
                    sidebarId: "docsSidebar",
                    position: "left",
                    label: "Documentação",
                },
                {
                    href: "https://github.com/nfse-nacional/nfse-php",
                    label: "GitHub",
                    position: "right",
                },
            ],
        },
        footer: {
            style: "dark",
            links: [
                {
                    title: "Documentação",
                    items: [
                        {
                            label: "Visão Geral",
                            to: "/docs/overview",
                        },
                        {
                            label: "DTOs e Validações",
                            to: "/docs/dtos",
                        },
                        {
                            label: "Assinatura Digital",
                            to: "/docs/digital-signature",
                        },
                        {
                            label: "Utilitários",
                            to: "/docs/utilities/id-generator",
                        },
                    ],
                },
                {
                    title: "Recursos",
                    items: [
                        {
                            label: "Exemplos de Código",
                            href: "https://github.com/nfse-nacional/nfse-php/tree/main/examples",
                        },
                        {
                            label: "Schemas XSD",
                            href: "https://github.com/nfse-nacional/nfse-php/tree/main/references/schemas",
                        },
                        {
                            label: "Changelog",
                            href: "https://github.com/nfse-nacional/nfse-php/releases",
                        },
                        {
                            label: "Roadmap",
                            to: "/#roadmap",
                        },
                    ],
                },
                {
                    title: "Comunidade",
                    items: [
                        {
                            label: "GitHub",
                            href: "https://github.com/nfse-nacional/nfse-php",
                        },
                        {
                            label: "Issues",
                            href: "https://github.com/nfse-nacional/nfse-php/issues",
                        },
                        {
                            label: "Discussões",
                            href: "https://github.com/nfse-nacional/nfse-php/discussions",
                        },
                        {
                            label: "Contribuir",
                            href: "https://github.com/nfse-nacional/nfse-php/blob/main/CONTRIBUTING.md",
                        },
                    ],
                },
                {
                    title: "Mais",
                    items: [
                        {
                            label: "Packagist",
                            href: "https://packagist.org/packages/nfse-nacional/nfse-php",
                        },
                        {
                            label: "NFSe Nacional",
                            href: "https://www.gov.br/nfse/",
                        },
                        {
                            label: "Spatie Laravel Data",
                            href: "https://spatie.be/docs/laravel-data",
                        },
                        {
                            label: "Licença MIT",
                            href: "https://github.com/nfse-nacional/nfse-php/blob/main/LICENSE",
                        },
                    ],
                },
            ],
            copyright: `
                <div style="margin-top: 1rem;">
                    <p>Copyright © ${new Date().getFullYear()} NFSe PHP. Construído com ❤️ usando Docusaurus.</p>
                    <p style="font-size: 0.875rem; opacity: 0.8; margin-top: 0.5rem;">
                        Projeto open-source sob licença MIT. Não afiliado ao governo brasileiro.
                    </p>
                </div>
            `,
        },
        prism: {
            theme: prismThemes.github,
            darkTheme: prismThemes.dracula,
            additionalLanguages: ["php", "json", "bash", "typescript"],
        },
    } satisfies Preset.ThemeConfig,
};

export default config;
