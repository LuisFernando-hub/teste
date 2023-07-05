<template>
  <div id="app">
    <nav class="navbar bg-primary" data-bs-theme="dark">
      <div class="container-fluid text-center justify-content-center">
        <p class="navbar-brand mb-0 h1 fs-1">Eletronicos</p>
      </div>
    </nav>

    <div class="container">
      <form class="row" @submit.prevent="create">
        <div class="col-md-12">
          <label class="form-label">Nome:</label>
          <input
            type="text"
            class="form-control"
            placeholder="Nome"
            v-model="eletronic.name"
          />
        </div>
        <div class="col-md-12">
          <label class="form-label">Descrição:</label>
          <input
            type="text"
            class="form-control"
            placeholder="Descrição"
            v-model="eletronic.description"
          />
        </div>
        <div class="col-md-6">
          <label class="form-label">Voltage:</label>
          <input
            type="number"
            class="form-control"
            placeholder="110"
            v-model="eletronic.voltage"
          />
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Marca:</label>
          <select class="form-select" v-model="eletronic.brand">
            <option disabled selected>Selecione uma Marca</option>
            <option value="1">teste</option>
          </select>
        </div>
        <div class="col-12 mb-3">
          <button type="submit" class="btn btn-success col-lg-1">Salvar</button>
        </div>
      </form>

      <table class="table table-hover">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Voltagem</th>
            <th>Marca</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="eletronic in eletronics" :key="eletronic.id">
            <td>{{ eletronic.name }}</td>
            <td>{{ eletronic.description }}</td>
            <td>{{ eletronic.voltage }}</td>
            <td>{{ eletronic.brand }}</td>
            <td>
              <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-warning">
                  Editar
                </button>
                <button type="button" class="btn btn-outline-danger">
                  Excluir
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Eletronic from "./services/eletronic";

export default {
  data() {
    return {
      eletronic: {
        name: "",
        description: "",
        voltage: "",
        brand: "",
      },
      eletronics: [],
    };
  },

  mounted() {
    Eletronic.getEletronic().then((res) => {
      this.eletronics = res.data.data;
    });
  },

  methods: {
    create() {
      console.log(this.eletronic);
      Eletronic.createEletronic(this.eletronic).then((res) => {
        console.log(res);
      });
    },
  },
};
</script>