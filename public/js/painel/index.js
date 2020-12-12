import Form from './Form.js';
import MenuBalance from './MenuBalance.js';
import MenuTransaction from './MenuTransaction.js';
import MenuAccount from './MenuAccount.js';
import PaymentTable from './PaymentTable.js';

const form = new Form();

const menuBalanceElement = document.querySelector('.menu-balance');
const paymentTableElement = document.querySelector('.payment-table');

const modalAddEarn = document.querySelector('#modalAddEarn');
const modalAddExpense = document.querySelector('#modalAddExpense');
const modalAddAccount = document.querySelector('#modalAddAccount');

const menuBalance = new MenuBalance(menuBalanceElement, form);
const paymentTable = new PaymentTable(paymentTableElement, form)

MenuTransaction(modalAddEarn, form);
MenuTransaction(modalAddExpense, form);

MenuAccount(modalAddAccount, menuBalance, form);

// jQuery - reset form on closing modal
$('.modal').on('hidden.bs.modal', function (e) {
  $(this).find('form')[0].reset();

  $(this).find('form .invalid-feedback').hide();
  $(this).find('form .success').hide();
});
