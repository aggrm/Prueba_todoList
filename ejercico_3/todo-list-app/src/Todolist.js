import React, { useState } from 'react';
import './TodoList.css';

function TodoList() {
    const [tasks, setTasks] = useState([]);
    const [task, setTask] = useState('');

    const handleAddTask = (event) => {
        event.preventDefault();
        if (task.trim() !== '') {
            setTasks([...tasks, task]);
            setTask('');
        }
    };

    return (
        <div className="todo-list-container">
            <h1>Lista de Tareas</h1>
            <form onSubmit={handleAddTask}>
                <input
                    type="text"
                    value={task}
                    onChange={(e) => setTask(e.target.value)}
                    placeholder="Agregar nueva tarea"
                />
                <button type="submit">Agregar Tarea</button>
            </form>
            <ul>
                {tasks.map((task, index) => (
                    <li key={index}>{task}</li>
                ))}
            </ul>
        </div>
    );
}

export default TodoList;
