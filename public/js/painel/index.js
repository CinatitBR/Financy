async function fetchContent(url) {
  const response = await fetch(url);

   // Handle fetch errors
  if (!response.ok) {
    const message = `An error has occured: ${response.status}`;
    throw new Error(message);
  }

  return await response.json();
}

async function sendFormData(formData, url) {
  const response = await fetch(url, { 
    method: 'POST', 
    body: formData 
  });

  // Handle fetch errors
  if (!response.ok) {
    const message = `An error has occured: ${response.status}`;
    throw new Error(message);
  }

  return await response.json();
}

function showFeedbacks(form, feedbacks) {
  for (const feedback of feedbacks) {
    const { element, message } = feedback;
    
    if (element === 'success') {
      form.reset();
    }

    const feedbackElement = form.querySelector(`.${element}`);

    feedbackElement.innerText = message;

    feedbackElement.classList.remove('hide');
    feedbackElement.classList.add('show');
  }
}

function getInputElements(form) {
  const fields = form.querySelectorAll('.field-list .item');
  let inputElements = [];

  for (const field of fields) {
    inputElements.push(field.children[1]);
  }

  return inputElements;
}

function hideErrorOnClick(form) {
  const inputElements = getInputElements(form);

  // Hide error feedback
  for (const input of inputElements) {
    const errorElement = input.nextElementSibling;

    input.addEventListener('click', () => { 
      errorElement.classList.remove('show');
      errorElement.classList.add('hide');
    });
  }
}

function hideSuccessOnClick(form) {
  const successElement = form.querySelector('.valid-feedback');

  form.addEventListener('click', () => { 
    successElement.classList.remove('show');
    successElement.classList.add('hide');
  });
}

async function getAccounts() {
  const url = `http://localhost/financy/account/getAccounts`;

  const accounts = await fetchContent(url);

  return accounts;
}

async function getCategoriesByFlow(flow) {
  const url = `http://localhost/financy/category/getCategories/${flow}`;

  const categories = await fetchContent(url);

  return categories;
}

async function getPayments() {
  const url = `http://localhost/financy/payment/getPayments`;

  const payments = await fetchContent(url);

  return payments;
}

async function addAccountsIntoSelect(select) {
  const accounts = await getAccounts();

  const accountsTemplate = accounts.map(({ account_id, balance, account_name }) => `
    <option value="${account_id}" data-balance="${balance}">
      ${account_name}
    </option>
  `).join('');

  select.insertAdjacentHTML('beforeend', accountsTemplate);
}

async function addCategoriesByFlowIntoSelect(select, flow) {
  const categories = await getCategoriesByFlow(flow);

  const categoriesTemplate = categories.map(({ category_id, category }) => `
    <option value="${category_id}">
      ${category}
    </option>
  `).join('');

  select.insertAdjacentHTML('beforeend', categoriesTemplate);
}

async function addPaymentsIntoTable() {
  const tableBody = document.querySelector('#payment_table_body');
  const payments = await getPayments();

  const paymentsTemplate  = payments.map(({ value, account_name, description, category, date, status }) => `
    <tr>
      <th scope="row">R$ ${value}</th>
      <td>${account_name}</td>
      <td>${description}</td>
      <td>${category}</td>
      <td>${date}</td>
      <td>${status}</td>
    </tr>
  `).join('');

  tableBody.insertAdjacentHTML('beforeend', paymentsTemplate);
}

function showBalanceIntoDisplay(event) {
  const elDisplayBalance = document.querySelector('#display_balance');
  const balance = event.target.options[event.target.selectedIndex].dataset.balance;

  elDisplayBalance.innerText = `R$ ${balance}`;
}

async function handleAddPaymentSubmit(event) {
  event.preventDefault();

  const form = event.target;
  const formData = new FormData(form);
  const flowType = form.dataset.flow;

  formData.append('flow', flowType);

  const urlAddPayment = `http://localhost/financy/payment/create`;
  const response = await sendFormData(formData, urlAddPayment);

  const { feedbacks, lastPaymentId } = response;

  showFeedbacks(form, feedbacks);

  // If new payment was added, update payment table
  // if (feedbacks[0].element === 'success') {
  //   addPaymentsIntoTable();
  // }
}

async function handleAddAccountSubmit(event) {
  event.preventDefault();

  const form = event.target;
  const formData = new FormData(form);

  const urlAddAccount = `http://localhost/financy/account/create`;
  const response = await sendFormData(formData, urlAddAccount);

  const { feedbacks, lastPaymentId } = response;

  showFeedbacks(form, feedbacks);
}

// MENU BALANCE
const elAccountToDisplay = document.querySelector('#account_to_display');

addAccountsIntoSelect(elAccountToDisplay)
  .then(() => {
    elAccountToDisplay.addEventListener('change', showBalanceIntoDisplay);
    elAccountToDisplay.dispatchEvent(new Event('change'));
  });

// MENU ADD PAYMENT
const formsAddPayment = document.querySelectorAll('.form-payment');

for (const form of formsAddPayment) {
  const elAccount = form.querySelector('.select-account');
  const elCategory = form.querySelector('.select-category');

  const flowType = form.dataset.flow;

  // Insert accounts and categories into selects
  addAccountsIntoSelect(elAccount);
  addCategoriesByFlowIntoSelect(elCategory, flowType);

  // Handle submit
  form.addEventListener('submit', handleAddPaymentSubmit);

  // Hide feedback messages on clicking
  hideSuccessOnClick(form);
  hideErrorOnClick(form);
}

// MENU ADD ACCOUNT
const formAddAccount = document.querySelector('#form_add_account');

// Handle submit
formAddAccount.addEventListener('submit', handleAddAccountSubmit);

// Hide feedback messages on clicking
hideSuccessOnClick(formAddAccount);
hideErrorOnClick(formAddAccount);

// PAYMENT TABLE
addPaymentsIntoTable();


// jQuery - reset form on closing modal
$('.modal').on('hidden.bs.modal', function (e) {
  $(this).find('form')[0].reset();

  $(this).find('form .invalid-feedback').hide();
  $(this).find('form .success').hide();
});
