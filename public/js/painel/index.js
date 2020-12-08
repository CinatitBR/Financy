import MenuBalance from './MenuBalance.js';
import MenuTransaction from './MenuTransaction.js';

const menuBalance = document.querySelector('.menu-balance');

const modalAddEarn = document.querySelector('#modalAddEarn');
const modalAddExpense = document.querySelector('#modalAddExpense');

MenuBalance(menuBalance);

MenuTransaction(modalAddEarn);
MenuTransaction(modalAddExpense);
