# API REST FastParking

API criada para gerenciar o estacionamento da FastParking.

Contola a listagem e inserção de preços, e listagem, inserção, editção e exclução de carros.

## Utilização
Configurar os arquivos:
- [**Model.php**](https://github.com/ItaloG/Projeto-FastParking-API/blob/main/Backend/App/Core/Model.php) com informações sobre o seu banco de dados;
- [**Router.php**](https://github.com/ItaloG/Projeto-FastParking-API/blob/main/Backend/App/Core/Router.php) com infomações dos recursos (campos) disponiveis no banco de dados.

- É necessário tem o **composer** instalado em sua maquina e alterar seus autoloads

## Entradas da API 

**URL**             | **Método**     | **Descrição**
--------------------|----------------|-
/Precos             | GET            | Retorna todos preços ja registrados no DB