document
  .querySelector("#insert-task-btn")
  .addEventListener("click", (event) => {
    event.preventDefault();
    tempForm = new FormData(document.querySelector("#insert-task-form"));
    fetch("php/todo-insert.php", {
      method: "POST",
      body: tempForm,
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        refreshList();
      });
  });

function refreshList() {
  let tasks = document.querySelector("#tasks");
  tasks.innerHTML = "";
  fetch("php/todo-fetch.php")
    .then((response) => response.json())
    .then((data) => {
      for (let task of data) {
        //console.log(task);
        let article = document.createElement("article");

        let img = document.createElement('img');
        if(task.completed == 1){
          img.src = "images/todone.png";
        }else{
          img.src = "images/todo.png";
        }
        
        img.id = task.ID;
        img.addEventListener('click', markCompleted);
        article.append(img);
        

        let span = document.createElement('span');
        span.textContent = task.task; /// loop-var.column-name
        article.append(span);
        
        tasks.append(article);
      }
    });
}
refreshList();

function markCompleted(event){
  event.preventDefault();
  console.log(event.target.id);
  let tempForm = new FormData();
  tempForm.append("ID", event.target.id);
  fetch("php/todo-update.php", {
    method: "POST",
    body: tempForm,
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      refreshList();
    });
}

