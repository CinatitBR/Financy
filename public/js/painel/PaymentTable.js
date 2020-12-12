export default function PaymentTable(paymentTableElement, form) {

  const tableBody = paymentTableElement.querySelector('tbody');
  const urlPayments = `http://localhost/financy/payment/getPayments`;

  function loadIntoTable(payments) {
    let trElements;

    for (const payment of payments) {
      trElements += `
        <tr>
          <th scope="row">${payment.value}</th>
          <td>${payment.account_name}</td>
          <td>${payment.category}</td>
          <td>${payment.date}</td>
          <td>${payment.status}</td>
        </tr>
      `;
    }

    tableBody.insertAdjacentHTML('beforeend', trElements);
  }

  async function init() {
    const payments = await form.fetchContent(urlPayments);

    loadIntoTable(payments);
  }

  init();
}