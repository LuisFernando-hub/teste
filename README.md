# BACKEND
### Entre no caminho /backend/teste_api

### rodar o npm install
### rodar o php artisan make:migration
### rodar o php artisan serve

# Endpoints 

### GET /eletronic para buscar todos os eletrodoméstico
### retorna todos os eletronicos em forma de json


### GET /eletronic/{id} para buscar um eletrodoméstico
### retorna o eletronico em forma de json

### POST /eletronic para inserir um eletrodoméstico passando um json por exemplo abaixo:
### {"name": "geladeira", "description": "Este produto é totalmente versátil", "voltage": 110, "brand": 1}
### o retorno do endpoint PUT deve ser um "message": "Eletrodoméstico criado com sucesso"

### PUT /eletronic/{id} para atualizar um eletrodoméstico passando um json por exemplo abaixo:
### {"name": "geladeira preta", "description": "Este produto é totalmente versátil", "voltage": 220, "brand": 1}
### o retorno do endpoint PUT deve ser um "message": "Eletrodoméstico editado com sucesso"

### DELETE /eletronic/{id} para excluir um eletrodoméstico
### o retorno do endpoint DELETE deve ser um "message": "Eletrodoméstico deletado com sucesso"


# FrontEnd

### Entre no caminho /frontend/teste_frontend

### rodar o npm install

### rodar o npm run dev