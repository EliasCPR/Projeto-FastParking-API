'use strict';

const openModalPrices = () => document.querySelector('#modal-Prices').classList.add('active');
const closeModalPrices = () => document.querySelector('#modal-Prices').classList.remove('active');

const openModalReceipt = () => document.querySelector('#modal-receipt').classList.add('active');
const closeModalReceipt = () => document.querySelector('#modal-receipt').classList.remove('active');

const openModalExit = () => document.querySelector('#modal-exit').classList.add('active');
const closeModalExit = () => document.querySelector('#modal-exit').classList.remove('active');

const openModalEdit = () => document.querySelector('#modal-edit').classList.add('active');
const closeModalEdit = () => document.querySelector('#modal-edit').classList.remove('active');


const getCar = async (url) => {
    const response = await fetch(url);
    const json = await response.json();
    return json;
}

const createCar = async (carro) => {
    const url = 'http://api.fastparking.com.br/carros';
    const opitions = {
        method: 'POST',
        body: JSON.stringify(carro)
    };
    await fetch(url, opitions);
}

const createPrice = async (preco) => {
    const url = 'http://api.fastparking.com.br/precos';
    const opitions = {
        method: 'POST',
        body: JSON.stringify(preco)
    };
    await fetch(url, opitions);
}


const createRow = (carro, index) => {
    const tableCars = document.querySelector('#tableCars tbody')
    const newTr = document.createElement('tr');
    // console.log(client);
    newTr.innerHTML = `                
        <td>${carro.nome}</td>
        <td>${carro.placa}</td>
        <td>${carro.dataEntrada}</td>
        <td>${carro.horaEntrada}</td>
        <td>
            <button data-index="${index}" id="button-receipt" class="button green" type="button">Comp.</button>
            <button data-index="${index}" id="button-edit" class="button blue" type="button">Editar</button>
            <button data-index="${index}" id="button-exit" class="button red" type="button">Saída</button>
        </td>`;

    if (carro.statusCarro == 1) {
        tableCars.appendChild(newTr);
    }
}

const clearInputs = () => {
    const inputs = Array.from(document.querySelectorAll('input'));
    inputs.forEach(input => input.value = "");
}

const clearTable = () => {
    const recordCar = document.querySelector('#tableCars tbody');
    while (recordCar.firstChild) {
        recordCar.removeChild(recordCar.lastChild);
    }
}

const updateTable = async () => {
    clearTable();
    const url = 'http://api.fastparking.com.br/carros';
    const carros = await getCar(url);
    carros.forEach(createRow);
}

const isValidFormRegister = () => document.querySelector('#form-register').reportValidity();

const saveCar = async () => {
    if (isValidFormRegister()) {
        const newCar = {
            nome: document.querySelector('#nome').value,
            placa: document.querySelector('#placa').value
        }
        await createCar(newCar);
        clearInputs();
        updateTable();
    }
}

const isValidFormPrice = () => document.querySelector('#form-price').reportValidity();

const savePrice = async () => {
    if (isValidFormPrice()) {
        const newPrice = {
            primeiraHora: document.querySelector('#primeira-hora').value,
            demaisHoras: document.querySelector('#demais-horas').value
        }
        await createPrice(newPrice);
        clearInputs();
        closeModalPrices();
    }
}


// MODAL DE PREÇOS
document.querySelector('#precos')
    .addEventListener('click', () => { openModalPrices(); clearInputs() });
document.querySelector('#close-prices')
    .addEventListener('click', () => { closeModalPrices(); clearInputs() });
document.querySelector('#cancelar-prices')
    .addEventListener('click', () => { closeModalPrices(); clearInputs() });
// *****************
// // SELETOR DOS BOTÕES
// document.querySelector('#tableCars').addEventListener('click', getButtons);
// ******************
//MODAL COMPROVANTE
document.querySelector('#close-receipt')
    .addEventListener('click', () => { closeModalReceipt(); clearInputs() });
document.querySelector('#cancelar-receipt')
    .addEventListener('click', () => { closeModalReceipt(); clearInputs() });
//MODAL SAÍDA
document.querySelector('#close-exit')
    .addEventListener('click', () => { closeModalExit(); clearInputs() });
document.querySelector('#cancelar-exit')
    .addEventListener('click', () => { closeModalExit(); clearInputs() });
//MODAL EDITAR
document.querySelector('#close-edit')
    .addEventListener('click', () => { closeModalEdit(); clearInputs() });
document.querySelector('#cancelar-edit')
    .addEventListener('click', () => { closeModalEdit(); clearInputs() });
//SALVAR CARRO
document.querySelector('#salvar')
    .addEventListener('click', saveCar);
//SALVAR PREÇO
document.querySelector('#salvarPreco')
    .addEventListener('click', savePrice);

updateTable();