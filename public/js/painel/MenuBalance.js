export default function MenuBalance(menuElement) {
  const accountSelect = menuElement.querySelector('#accountSelect');

  this.lastAccountId = 0;

  this.updateSelect = async () => {
    const url = `http://localhost/financy/account/getAccountsByLastId/${this.lastAccountId}`;

    const accounts = await fetchContent(url);

    loadIntoSelect(accounts, accountSelect);
  }

  async function fetchContent(url) {
    const response = await fetch(url);

     // Handle fetch errors
    if (!response.ok) {
      const message = `An error has occured: ${response.status}`;
      throw new Error(message);
    }

    return await response.json();
  }

  // Populate select with accounts
  function loadIntoSelect(accounts, select) {
    let optionElements;

    for (const account of accounts) {
      optionElements += `
        <option value="${account.balance}">
          ${account.account_name}
        </option>
      `;
    }

    select.insertAdjacentHTML('beforeend', optionElements)
  }

  // Show balance of selected account
  function showBalance(event) {
    const menuContent = menuElement.querySelector('.menu-content');
    const balance = event.target.value;
  
    menuContent.innerText = `R$ ${balance}`;
  }

  async function init() {
    const urlAccounts = `http://localhost/financy/account/getAccounts`;
    
    const accounts = await fetchContent(urlAccounts);

    loadIntoSelect(accounts, accountSelect);

    // Add event to select and force event to trigger
    accountSelect.addEventListener('change', showBalance);
    accountSelect.dispatchEvent(new Event('change'));
  }

  init();
}
