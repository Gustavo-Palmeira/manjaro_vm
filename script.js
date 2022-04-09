const api = "http://127.0.0.1/api-rest/api-rest";

async function submitPlayer() {
	const name = document.querySelector("#name").value;
	const birthday = document.querySelector("#birthday").value;
	const height = document.querySelector("#height").value;

  const payload = { name, birthday, height };

	const response = await fetch(`${api}/create.php`, {
		method: 'POST',
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(payload),
	});

	const json = await response.json();
	console.log("json");
}

async function deletePlayer(id) {
  const payload = { id };

	const response = await fetch(`${api}/delete.php`, {
		method: "DELETE",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(payload),
	});

	const json = await response.json();
	console.log("json");
}

async function submitEditPlayer(id) {
	const name = document.querySelector("#editName").value;
	const birthday = document.querySelector("#editBirthday").value;
	const height = document.querySelector("#editHeight").value;

  const payload = { id, name, birthday, height };

	const response = await fetch(`${api}/update.php`, {
		method: "PUT",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(payload),
	});

	const json = await response.json();
	console.log("json");
}

async function editPlayer({ id, name, height, birthday }) {
	const editForm = document.querySelector(".edit-form");
	const slicedDate = new Date(birthday).toLocaleDateString("pt-BR").split("/");
	const formatDate = `${slicedDate[2]}-${slicedDate[1]}-${slicedDate[0]}`;

	editForm.innerHTML = `
  <form onsubmit="return false">
  <div class="form-group">
    <div class="my-4">
      <label for="name">Nome</label>
      <input class="form-control" value="${name}" type="text" name="editName" id="editName" placeholder="Nome" />
    </div>
    <div class="my-4">
      <label for="height">Altura</label>
      <input class="form-control" value="${height}" type="number" name="editHeight" id="editHeight" placeholder="Altura" step="0.01" />
    </div>
    <div class="my-4">
      <label for="birthday">Data de nascimento</label>
      <input class="form-control" value="${formatDate}" type="date" name="editBirthday" id="editBirthday"
        placeholder="Data de nascimento" />
    </div>
    <button type="submit" onclick="submitEditPlayer(${id})">Editar</button>
  </div>
</form>
  `;
}

async function getPlayers() {
	const div = document.querySelector(".players");

	const response = await fetch(`${api}/`, {
		method: "GET",
		headers: {
			"Content-Type": "application/json",
		},
	});
	const players = await response.json();

	for (let index = 0; index < players.length; index++) {
		div.innerHTML += `
    <div class="d-flex justify-content-between my-5 bg-light border rounded-2 p-3">
      <div>
        <h3 class="h4">ID</h3>
        <p>${players[index].id}</p>
      </div>
      <div>
        <h3 class="h4">Nome</h3>
        <p>${players[index].name}</p>
      </div>
      <div>
        <h3 class="h4">Altura</h3>
        <p>${players[index].height}</p>
      </div>
      <div>
        <h3 class="h4">Nascimento</h3>
        <p>${players[index].birthday}</p>
      </div>
      <div class="d-flex align-items-center">
        <button class="m-3" onclick="deletePlayer(${
					players[index].id
				})">Excluir</button>
        <button class="m-3" onclick="editPlayer({ id: ${
					players[index].id
				}, name: '${players[index].name}', height: '${
			players[index].height
		}', birthday: '${players[index].birthday}' })">Editar</button>
      </div>
    </div>`;
	}
}

getPlayers();
