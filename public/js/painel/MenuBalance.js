export default function MenuBalance(menuBalance) {

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
  function populateAccountSelect(accounts, accountSelect) {
    for (const account of accounts) {
      const option = document.createElement("option");
  
      option.value = account.balance;
      option.innerText = account.account_name;
  
      accountSelect.appendChild(option);
    }
  }

  // Show balance of selected account
  function showBalance(event) {
    const menuContent = menuBalance.querySelector('.menu-content');
    const balance = event.target.value;
  
    menuContent.innerText = `R$ ${balance}`;
  }

  async function init(menuBalance) {
    const accountSelect = menuBalance.querySelector('#accountSelect');
    const urlAccounts = `http://localhost/financy/addAccount/getAccounts`;
    const changeEvent = new Event('change');
    
    const accounts = await fetchContent(urlAccounts);

    populateAccountSelect(accounts, accountSelect);

    // Add change event
    accountSelect.addEventListener('change', showBalance);

    // Force the event to trigger
    accountSelect.dispatchEvent(changeEvent);
  }

  init(menuBalance);
}
