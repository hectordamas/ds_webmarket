function initializeDataTable() {
	if($('#datatable-buttons-table').length){
		tableApp = $('#datatable-buttons-table').DataTable({
			deferRender: true, // Solo renderiza lo visible
			order: [[0, 'desc']],
			responsive: true,
			lengthChange: false,
			autoWidth: false,
			lengthMenu: [
				[10, 50, 100, 150, -1],
				[10, 50, 100, 150, 'Todos']
			],
			dom: 'Bfrtip',
			buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],	
			language: {
				sProcessing: "Procesando...",
				sLengthMenu: "Mostrar _MENU_ registros",
				sZeroRecords: "No se encontraron resultados",
				sEmptyTable: "Ningún dato disponible en esta tabla",
				sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
				sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
				sSearch: "Buscar:",
				oPaginate: {
					sFirst: "Primero",
					sLast: "Último",
					sNext: "Siguiente",
					sPrevious: "Anterior"
				},
			}
		});
	}
}

$(document).ready(function(){
    initializeDataTable();

})