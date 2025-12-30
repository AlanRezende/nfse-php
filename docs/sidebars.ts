import type { SidebarsConfig } from "@docusaurus/plugin-content-docs";

const sidebars: SidebarsConfig = {
    docsSidebar: [
        "overview",
        "full-example",
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
        {
            type: "category",
            label: "Exemplos Práticos",
            items: [
                "examples/tomador-pf",
                "examples/tomador-pj",
                "examples/tomador-exterior",
                "examples/construcao-civil",
                "examples/retencoes",
                "examples/exportacao",
            ],
        },
        "advanced-scenarios",
        "typescript",
        "schema-rules",
    ],
};

export default sidebars;
