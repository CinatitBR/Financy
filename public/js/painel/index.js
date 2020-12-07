import MenuBalance from './MenuBalance.js';
import MenuTransaction from './MenuTransaction.js';

const menuBalance = document.querySelector('.menu-balance');
const modalAddEarn = document.querySelector('#modalAddEarn');

new MenuBalance(menuBalance);

new MenuTransaction(modalAddEarn);
