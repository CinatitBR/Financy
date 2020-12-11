export default function MenuAccount(menuElement, menuBalance, form) {

  async function handleSubmit(event) {
    event.preventDefault();

    const formElement = event.target;
    const formData = new FormData(formElement);

    const url = `http://localhost/financy/account/create`;
    const response = await form.sendFormData(formData, url);

    const feedbacks = response.feedbacks;
    const lastAccountId = response.lastAccountId;

    form.showFeedbacks(formElement, feedbacks);

    // If lastAccountId exists, update "select element" of menuBalance
    if (lastAccountId) {
      menuBalance.updateSelect(lastAccountId);
    }
  }

  async function init() {
    const formElement = menuElement.querySelector('form');

    formElement.addEventListener('submit', handleSubmit);

    form.hideFeedbackOnClick(formElement);
  }

  init();
}