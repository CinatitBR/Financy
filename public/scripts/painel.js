const selectAccount = document.querySelector('#selectAccount');
const alertSelect = document.querySelector('#alertSelect');

const url = `http://localhost/financy/addAccount/getAccounts`;

fetchAccounts(url)
  .then(accounts => { 
    populateSelect(accounts, selectAccount, alertSelect);
  })
  .then(() => {
    selectAccount.addEventListener('change', showBalance);

    // Force the event to trigger
    const event = new Event('change');
    selectAccount.dispatchEvent(event);
  })
  .catch(error => console.log(error));

function fetchAccounts(url) {
  return fetch(url)
    .then(response => {
      return response.json();
    })
    .catch(error => console.log(error));
}

function populateSelect(accounts, select, alertSelect) {
  // If there are no accounts
  if (accounts.length === 0) {
    select.style.display = 'none';
    alertSelect.style.display = 'block';

    return;
  }

  for (account of accounts) {
    const option = document.createElement("option");

    option.value = account.balance;
    option.innerText = account.account_name;

    select.appendChild(option);
  }
}

function showBalance(event) {
  const menuContent = document.querySelector('.menu-balance .menu-content');

  const balance = event.target.value;

  menuContent.innerText = `R$ ${balance}`;
}