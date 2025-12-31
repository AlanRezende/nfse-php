import type { SidebarsConfig } from "@docusaurus/plugin-content-docs";

const sidebars: SidebarsConfig = {
    docsSidebar: [
        "overview",
        {
            type: "category",
            label: "Exemplos Práticos",
            items: [
                "full-example",
                "examples/tomador-pf",
                "examples/tomador-pj",
                "examples/tomador-exterior",
                "examples/construcao-civil",
                "examples/retencoes",
                "examples/pis-cofins",
                "examples/exportacao",
                "advanced-scenarios",
            ],
        },
        {
            type: "category",
            label: "Tipos (DTOs)",
            items: [
                "types/main-documents",
                "types/base-info",
                "types/actors",
                "types/service-location",
                "types/values-taxation",
                "types/deductions",
                "types/others",
            ],
        },
        "dtos",
        "validations",
        "xml-serialization",
        "digital-signature",
        "signing-dps",
        "xml-signer",
        {
            type: "category",
            label: "Utilitários",
            items: [
                "utilities/document-formatter",
                "utilities/tax-calculator",
                "utilities/id-generator",
                "utilities/document-generator",
            ],
        },
        "typescript",
        "schema-rules",
    ],
};

export default sidebars;
