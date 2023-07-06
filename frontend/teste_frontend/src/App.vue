<template>
  <div id="app">
    <nav class="navbar bg-primary" data-bs-theme="dark">
      <div class="container-fluid text-center justify-content-center">
        <p class="navbar-brand mb-0 h1 fs-1">Eletronicos</p>
      </div>
    </nav>
    <div class="container">
      <form class="row" @submit.prevent="createOfUpdate">
        <div class="col-md-12">
          <label class="form-label">Nome:</label>
          <input
            type="text"
            class="form-control"
            placeholder="Nome"
            v-model="eletronic.name"
            v-on:change="validacao"
          />
        </div>
        <div class="error text-danger">{{ errors.name && errors.name[0] }}</div>
        <div class="col-md-12">
          <label class="form-label">Descrição:</label>
          <input
            type="text"
            class="form-control"
            placeholder="Descrição"
            v-model="eletronic.description"
            v-on:change="validacao"
          />
        </div>
        <div class="error text-danger">
          {{ errors.description && errors.description[0] }}
        </div>
        <div class="col-md-6">
          <label class="form-label">Voltagem:</label>
          <input
            type="number"
            class="form-control"
            placeholder="110"
            v-model="eletronic.voltage"
            v-on:change="validacao"
          />
        </div>
        <div class="col-md-6">
          <label class="form-label">Marca:</label>
          <select
            class="form-select"
            v-model="selectedBrand"
            @change="validacao"
          >
            <option value="" selected>Selecione uma Marca</option>
            <option
              v-for="(brand, index) of brands"
              :value="index"
              :key="index"
            >
              {{ brand }}
            </option>
          </select>
        </div>

        <div class="error text-danger mb-3 col-md-6">
          {{ errors.voltage && errors.voltage[0] }}
        </div>

        <div class="error text-danger col-md-6">
          {{ errors.brand && errors.brand[0] }}
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
            <td>{{ eletronic.voltage }}v</td>
            <td>{{ eletronic.brand }}</td>
            <td>
              <div class="d-flex gap-2">
                <button
                  type="button"
                  @click="btnUpdate(eletronic)"
                  class="btn btn-outline-warning"
                >
                  Editar
                </button>
                <button
                  @click="deleteEletronic(eletronic)"
                  type="button"
                  class="btn btn-outline-danger"
                >
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
        id: "",
        name: "",
        description: "",
        voltage: "",
        brand: "",
      },
      selectedBrand: "",
      eletronics: [],
      brands: [],
      errors: {},
    };
  },

  mounted() {
    this.list();
  },

  methods: {
    //Listagem do dados
    list() {
      Eletronic.getEletronic().then((res) => {
        this.eletronics = res.data;
        this.brands = res.data.brands;
        delete this.eletronics.brands;
      });
    },

    //Crianção e Atualização do eletrodomestico
    createOfUpdate() {
      this.eletronic.brand = this.selectedBrand;

      if (!this.eletronic.id) {
        Eletronic.createEletronic(this.eletronic)
          .then((res) => {
            Swal.fire("", res.data.message, "success");
            this.eletronic = {};
            this.list();
            this.errors = [];
            this.selectedBrand = "";
          })
          .catch((e) => {
            this.errors = e.response.data.errors || [];
          });
      } else {
        Eletronic.updateEletronic(this.eletronic)
          .then((res) => {
            Swal.fire("", res.data.message, "success");
            this.eletronic = {};
            this.list();
            this.errors = [];
            this.selectedBrand = "";
          })
          .catch((e) => {
            this.errors = e.response.data.errors || [];
          });
      }
    },

    //Deletar eletronico
    deleteEletronic(eletronic) {
      Swal.fire({
        title: "Deseja excluir o eletronico?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim",
        cancelButtonText: "Não",
      }).then((result) => {
        if (result.isConfirmed) {
          Eletronic.deleteEletronic(eletronic)
            .then((res) => {
              Swal.fire("", res.data.message, "success");
              this.eletronic = {};
              this.list();
              this.errors = [];
              this.selectedBrand = "";
            })
            .catch((e) => {
              this.errors = e.response.data.errors || [];
            });
        }
      });
    },

    //Botão para atualizar
    btnUpdate(eletronic) {
      for (const key in this.brands) {
        if (this.brands[key] == eletronic.brand) {
          this.selectedBrand = key;
          break;
        }
      }
      this.eletronic = eletronic;
    },

    //Validação do submit do form
    validacao() {
      if (this.eletronic.name != "") {
        this.errors.name = "";
      }
      if (this.eletronic.description != "") {
        this.errors.description = "";
      }
      if (this.eletronic.voltage != "") {
        this.errors.voltage = "";
      }
      if (this.selectedBrand != "") {
        this.errors.brand = "";
      }
    },
  },
};
</script>