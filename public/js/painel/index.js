// import Store from './Store.js';
import MenuBalance from './MenuBalance.js';
import MenuTransaction from './MenuTransaction.js';
import MenuAccount from './MenuAccount.js';

const menuBalanceElement = document.querySelector('.menu-balance');

const modalAddEarn = document.querySelector('#modalAddEarn');
const modalAddExpense = document.querySelector('#modalAddExpense');
const modalAddAccount = document.querySelector('#modalAddAccount');

const menuBalance = new MenuBalance(menuBalanceElement);

MenuTransaction(modalAddEarn);
MenuTransaction(modalAddExpense);

MenuAccount(modalAddAccount, menuBalance);

// Reset form on closing modal (jQuery)
$('.modal').on('hidden.bs.modal', function (e) {
  $(this).find('form')[0].reset();

  $(this).find('form .invalid-feedback').hide();
  $(this).find('form .success').hide();
});
