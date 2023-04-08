const message = document.getElementById('message');
const messageCount = document.getElementById('message-count');

message.addEventListener('input', () => {
  const count = message.value.length;
  messageCount.innerText = `${count} 文字`;
});