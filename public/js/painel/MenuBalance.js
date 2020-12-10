export default function MenuBalance(menuElement) {

  this.lastAccountId = 0;

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
  function loadIntoSelect(accounts, accountSelect) {
    let optionElements;

    for (const account of accounts) {
      optionElements += `
        <option value="${account.balance}">
          ${account.account_name}
        </option>
      `;
    }

    accountSelect.innerHTML = optionElements;
  }

  // Show balance of selected account
  function showBalance(event) {
    const menuContent = menuElement.querySelector('.menu-content');
    const balance = event.target.value;
  
    menuContent.innerText = `R$ ${balance}`;
  }


  async function init(menuElement) {
    const accountSelect = menuElement.querySelector('#accountSelect');
    const urlAccounts = `http://localhost/financy/account/getAccounts`;
    const changeEvent = new Event('change');
    
    const accounts = await fetchContent(urlAccounts);

    loadIntoSelect(accounts, accountSelect);

    // Add event to select
    accountSelect.addEventListener('change', showBalance);

    // Force the event to trigger
    accountSelect.dispatchEvent(changeEvent);
  }

  init(menuElement);
}
