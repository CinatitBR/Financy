let paymentOffset = 0;

const btnNextWrapper = document.querySelector('.pagination-next__wrapper');

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

function getValuesInsideSelect(select) {
  // console.log(select);
  const options = Array.from(select.querySelectorAll('option'));

  const values = options.map(option => {
    return option.value;
  });

  return values;
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

async function getPayments(paymentOffset) {
  const url = `http://localhost/financy/payment/getPayments/${paymentOffset}`;

  const payments = await fetchContent(url);

  return payments;
}

async function addAccountsIntoSelect(select) {
  const accounts = await getAccounts();

  const accountsTemplate = accounts.map(({ account_id, balance, account_name }) => {
    return `
      <option value="${account_id}" data-balance="${balance}">
        ${account_name}
      </option>
    `;
  }).join('');

  select.innerHTML = accountsTemplate;
}

async function addCategoriesByFlowIntoSelect(select, flow) {
  const categories = await getCategoriesByFlow(flow);

  // Get ids inside the select
  const idsInsideSelect = getValuesInsideSelect(select);
  
  const categoriesTemplate = categories.map(({ category_id, category }) => {
    
    const isIdInsideSelect = idsInsideSelect.includes(category_id);

    // If the category_id is not inside the select
    if (!isIdInsideSelect) {
      return `
        <option value="${category_id}">
          ${category}
        </option>
      `;
    }

  }).join('');

  select.insertAdjacentHTML('beforeend', categoriesTemplate);
}

async function addPaymentsIntoTable() {
  const table = document.querySelector('#payment-table__wrapper');
  const tableBody = table.querySelector('#payment_table_body');

  let paymentsTemplate;
  
  const payments = await getPayments(paymentOffset);

  if (payments.length === 0) {
    paymentsTemplate = `
      <tr data-payment-id="">
        <th scope="row" colspan="6" style="text-align: center;">
          Você ainda não adicionou nenhum pagamento
        </th>
      </tr>
    `;
  }
  else {
    paymentsTemplate  = payments.map(({ payment_id, value, account_name, description, category, date, status }) => {
      return `
        <tr data-payment-id="${payment_id}">
          <th scope="row">R$ ${value}</th>
          <td>${account_name}</td>
          <td>${description}</td>
          <td>${category}</td>
          <td>${date}</td>
          <td>${status}</td>
        </tr>
      `;
    }).join('');
  }


  tableBody.innerHTML = paymentsTemplate;
}

function showBalanceIntoDisplay(event) {
  const elDisplayBalance = document.querySelector('#display_balance');
  const balance = event.target.options[event.target.selectedIndex].dataset.balance;

  elDisplayBalance.innerText = `R$ ${balance}`;
}

// Set state of next pagination button
async function setNextBtnState() {
  const nextPaginationExists = await getPayments(paymentOffset + 10);

  if (nextPaginationExists.length > 0) {
    btnNextWrapper.classList.remove('disabled');
  }
  else if (nextPaginationExists.length === 0) {
    btnNextWrapper.classList.add('disabled');
  }
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

  // If new payment was added successfully
  if (feedbacks[0].element === 'success') {
    setNextBtnState();
    addPaymentsIntoTable();

    addAccountsIntoSelect(elAccountToDisplay)
      .then(() => {
        elAccountToDisplay.dispatchEvent(new Event('change'));
      })
  }
}

async function handleAddAccountSubmit(event) {
  event.preventDefault();

  const form = event.target;
  const formData = new FormData(form);

  const urlAddAccount = `http://localhost/financy/account/create`;
  const response = await sendFormData(formData, urlAddAccount);

  const { feedbacks, lastPaymentId } = response;

  showFeedbacks(form, feedbacks);

  // If the new account was added, update selects
  if (feedbacks[0].element === 'success') {
    const selectsToBeUpdated = Array.from(document.querySelectorAll('.select-account'));

    for (const select of selectsToBeUpdated) {
      addAccountsIntoSelect(select);
    }
  }
}

async function handleAddCategorySubmit(event) {
  event.preventDefault();

  const form = event.target;
  const formData = new FormData(form);

  const urlAddCategory = `http://localhost/financy/category/create`;
  const response = await sendFormData(formData, urlAddCategory);

  const { feedbacks, lastPaymentId } = response;

  showFeedbacks(form, feedbacks);

  // If the new category was added, update category select
  if (feedbacks[0].element === 'success') {
    const categoryFlow = formData.get('flow');

    const selectToBeUpdated = document.querySelector(`
      .form-payment[data-flow="${categoryFlow}"] .select-category
    `);

    addCategoriesByFlowIntoSelect(selectToBeUpdated, categoryFlow);
  }
}

// === MENU BALANCE ===
const elAccountToDisplay = document.querySelector('#account_to_display');

addAccountsIntoSelect(elAccountToDisplay)
  .then(() => {
    elAccountToDisplay.addEventListener('change', showBalanceIntoDisplay);
    elAccountToDisplay.dispatchEvent(new Event('change'));
  });

// === MENU ADD PAYMENT ===
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

// === MENU ADD ACCOUNT ===
const formAddAccount = document.querySelector('#form_add_account');

// Handle submit
formAddAccount.addEventListener('submit', handleAddAccountSubmit);

// Hide feedback messages on clicking
hideSuccessOnClick(formAddAccount);
hideErrorOnClick(formAddAccount);

// === MENU ADD CATEGORY ===
const formAddCategory = document.querySelector('#form_add_category');

// Handle submit
formAddCategory.addEventListener('submit', handleAddCategorySubmit);

// Hide feedback messages on clicking
hideSuccessOnClick(formAddCategory);
hideErrorOnClick(formAddCategory);

// === PAYMENT TABLE ===
addPaymentsIntoTable();

// === PAGINATION ===
const btnPreviousWrapper = document.querySelector('.pagination-previous__wrapper');

const btnNext = document.querySelector('#pagination_next');
const btnPrevious = document.querySelector('#pagination_previous');

// Set state of next button
setNextBtnState();

btnNext.addEventListener('click', (event) => {
  event.preventDefault();

  paymentOffset += 10;
  addPaymentsIntoTable();
  setNextBtnState();

  if (paymentOffset > 0) {
    btnPreviousWrapper.classList.remove('disabled');
  }
});

btnPrevious.addEventListener('click', (event) => {
  event.preventDefault();

  if (paymentOffset === 10) {
    btnPreviousWrapper.classList.add('disabled');
  }

  paymentOffset -= 10;

  addPaymentsIntoTable();
  setNextBtnState()
});


// jQuery - reset form on closing modal
$('.modal').on('hidden.bs.modal', function (e) {
  $(this).find('form')[0].reset();

  $(this).find('form .invalid-feedback').hide();
  $(this).find('form .success').hide();
});
