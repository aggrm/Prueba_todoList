$(document).ready(function() {
    // Manejar el envío del formulario
    $('#taskForm').submit(function(event) {
        event.preventDefault();
        let taskTitle = $('#taskTitle').val();
        if (taskTitle) {
            addTask(taskTitle);
            $('#taskTitle').val('');
        }
    });

    // Función para agregar una tarea a la lista
    function addTask(title) {
        let taskRow = $('<tr>');
        let taskTitleCell = $('<td>').text(title);
        let taskActionsCell = $('<td>');
        let deleteButton = $('<button>').text('Eliminar').click(function() {
            taskRow.remove();
        });
        taskActionsCell.append(deleteButton);
        taskRow.append(taskTitleCell, taskActionsCell);
        $('#taskList').append(taskRow);
    }

    // Manejar el botón de mostrar/ocultar tareas
    $('#toggleTasks').click(function() {
        $('#taskTable').toggle();
        let isVisible = $('#taskTable').is(':visible');
        $(this).text(isVisible ? 'Ocultar Tareas' : 'Mostrar Tareas');
    });
});
