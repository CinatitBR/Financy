import Form from './Form.js';
import MenuBalance from './MenuBalance.js';
import MenuTransaction from './MenuTransaction.js';
import MenuAccount from './MenuAccount.js';

const form = new Form();

const menuBalanceElement = document.querySelector('.menu-balance');

const modalAddEarn = document.querySelector('#modalAddEarn');
const modalAddExpense = document.querySelector('#modalAddExpense');
const modalAddAccount = document.querySelector('#modalAddAccount');

const menuBalance = new MenuBalance(menuBalanceElement, form);

MenuTransaction(modalAddEarn, form);
MenuTransaction(modalAddExpense, form);

MenuAccount(modalAddAccount, menuBalance, form);

// Reset form on closing modal (jQuery)
$('.modal').on('hidden.bs.modal', function (e) {
  $(this).find('form')[0].reset();

  $(this).find('form .invalid-feedback').hide();
  $(this).find('form .success').hide();
});
