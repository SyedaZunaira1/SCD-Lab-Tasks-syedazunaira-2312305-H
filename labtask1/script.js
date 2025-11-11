const task_input = document.getElementById('input_text');
const clear_but = document.getElementById('clear_but');
const add = document.getElementById('add');
const list = document.getElementById('list');

function add_task(){
    const taskText = task_input.value.trim();

    if(taskText === ''){
        alert('please enter task!');
        return;
    }

    const li = document.createElement('li');

    const takespan = document.createElement('span');
    takespan.className = 'task-text';
    takespan.textContent = taskText;

    const delete_but = document.createElement('button');
    delete_but.className = 'delete_but';
    delete_but.textContent = 'Delete';
    delete_but.onclick = function(){
        deleteTask(taskText, li);
    };

    li.appendChild(takespan);
    li.appendChild(delete_but);
    list.appendChild(li);

    save_task(taskText);
    task_input.value = '';
    alert('Task added successfully!');
}

function deleteTask(taskText, liElement){
    liElement.remove();

    let tasks = get_task();
    tasks = tasks.filter(task => task !== taskText);
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

function clear_task(){
    if(list.children.length === 0){
        alert('No tasks to clear!');
        return;
    }

    if(confirm('Are you sure you want to clear all tasks?')){
        list.innerHTML = '';
        localStorage.removeItem('tasks');
        alert('All tasks cleared successfully!');
    }
}

function save_task(task){
    let tasks = get_task();
    tasks.push(task);
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

function get_task(){
    if(localStorage.getItem('tasks') === null){
        return [];
    } else {
        return JSON.parse(localStorage.getItem('tasks'));
    }
}

function load_task(){
    let tasks = get_task();
    
    tasks.forEach(task => {
        const li = document.createElement('li');
        
        const takespan = document.createElement('span');
        takespan.className = 'task-text';
        takespan.textContent = task;
        
        const delete_but = document.createElement('button');
        delete_but.className = 'delete_but';
        delete_but.textContent = 'Delete';
        delete_but.onclick = function(){
            deleteTask(task, li);
        };
        
        li.appendChild(takespan);
        li.appendChild(delete_but);
        list.appendChild(li);
    });
}

add.addEventListener('click', add_task);
clear_but.addEventListener('click', clear_task);
task_input.addEventListener('keypress', function(e){
    if(e.key === 'Enter'){
        add_task();
    }
});
document.addEventListener('DOMContentLoaded', load_task);