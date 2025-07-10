 window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
     if (datatablesSimple) {
      
      $(datatablesSimple).DataTable({
        // Opciones personalizadas si las necesitas
        paging: true,  
        searching: true,  
        info: true,  
        lengthChange: true, 
        language: {
            "lengthMenu": 'Mostrar <select>' +
                        '<option value="2">2</option>' +
                        '<option value="5">5</option>' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="-1">Todas</option>' +
                        '</select> registros por página.',
            "zeroRecords": "No existen registros con esos parámetros.",    
            "info": "Página _PAGE_ de _PAGES_",     
            "infoEmpty": "No existen registros.",   
            "loadingRecords": "Cargando registros...",
            "processing": "Procesando registros...",
            "search": "Buscar en la tabla: ",
            "infoFiltered": "(filtrado para un máximo de _MAX_ registros)",
            url: 'https://cdn.datatables.net/plug-ins/1.13.3/i18n/es-MX.json', // Para usar en español
            "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": ">",
                        "previous": "<"
                    }
            





        }
    });
    } 
}); 