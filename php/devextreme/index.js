// This code is used for backwards compatibility with the older jsPDF variable name
// Read more: https://github.com/MrRio/jsPDF/releases/tag/v2.0.0
window.jsPDF = window.jspdf.jsPDF;

//Guardar la hora

const tiempoTranscurrido = Date.now();
const hoy = new Date(tiempoTranscurrido);

$(() => {
    $('#gridContainer').dxDataGrid({
        dataSource: 'datos.json',
        keyExpr: 'id',
        allowColumnReordering: true,
        showBorders: true,
        grouping: {
            autoExpandAll: true,
        },
        selection: {
            mode: 'multiple',
        },
        paging: {
            pageSize: 10,
        },
        columns: [
            'id',
            'id_venta',
            'id_producto',
            'cantidad',
            {
                dataField: 'id_venta',
                groupIndex: 0,
            },
        ],
        export: {
            enabled: true,
            formats: ['pdf'],
            allowExportSelectedData: true,
        },
        onExporting(e) {
            const doc = new jsPDF();

            DevExpress.pdfExporter.exportDataGrid({
                jsPDFDocument: doc,
                component: e.component,
                indent: 5,
            }).then(() => {
                doc.save('ReporteVentas' + hoy.toISOString() + '.pdf');
            });
        },
        headerFilter: {
            visible: true
        },
        searchPanel: {
            visible: true,
            width: 300,
            placeholder: 'Busca por el pinche ID...'
        },
        title: {
            text: 'hola',
            horizontalAlignment: 'center',
            font: {
                size: 30,
                color: '#CFB53B',
            },
            margin: {
                top: 25,
            },
        },
    });
});
