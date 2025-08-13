// script.js

document.addEventListener("DOMContentLoaded", function () {
  const chatbotContainer = document.getElementById("chatbot-container");
  const closeBtn = document.getElementById("close-btn");
  const sendBtn = document.getElementById("send-btn");
  const chatbotInput = document.getElementById("chatbot-input");
  const chatbotBody = document.getElementById("chatbot-body");
  const chatbotMessages = document.getElementById("chatbot-messages");
  const chatbotIcon = document.getElementById("chatbot-icon");

  let thinkingIntervalId = null;
  const SCROLL_THRESHOLD = 50; // Jarak (dalam piksel) dari bawah untuk dianggap "di bawah"

  function animateThinking(element) {
    if (thinkingIntervalId) {
      clearInterval(thinkingIntervalId);
    }
    let dotCount = 1;
    const baseText = "Thinking";
    element.textContent = baseText + ".".repeat(dotCount);
    thinkingIntervalId = setInterval(() => {
      dotCount = (dotCount % 3) + 1;
      element.textContent = baseText + ".".repeat(dotCount);
    }, 400);
  }

  function stopThinkingAnimation() {
    if (thinkingIntervalId) {
      clearInterval(thinkingIntervalId);
      thinkingIntervalId = null;
    }
  }

  // Fungsi untuk melakukan scroll ke bawah jika pengguna ada di bawah
  function scrollToBottomIfNear() {
    // Cek apakah pengguna berada di dekat bagian bawah sebelum melakukan scroll
    // scrollHeight: total tinggi konten
    // scrollTop: seberapa jauh dari atas pengguna telah scroll
    // clientHeight: tinggi viewport dari elemen scrollable
    const isNearBottom = (chatbotBody.scrollHeight - chatbotBody.scrollTop - chatbotBody.clientHeight) < SCROLL_THRESHOLD;
    
    if (isNearBottom) {
      chatbotBody.scrollTop = chatbotBody.scrollHeight;
    }
  }

  chatbotIcon.addEventListener("click", function () {
    chatbotContainer.classList.remove("hidden");
    chatbotIcon.style.display = "none";
  });

  closeBtn.addEventListener("click", function () {
    chatbotContainer.classList.add("hidden");
    chatbotIcon.style.display = "flex";
  });

  sendBtn.addEventListener("click", sendMessage);
  chatbotInput.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
      sendMessage();
    }
  });

  async function sendMessage() {
    const userMessage = chatbotInput.value.trim();
    if (userMessage) {
      appendMessage("user", userMessage);
      chatbotInput.value = "";
      await getBotResponse(userMessage);
    }
  }

  function appendMessage(sender, message) {
    const messageElement = document.createElement("div");
    messageElement.classList.add("message", sender);
    messageElement.innerHTML = message.replace(/\n/g, "<br>");
    chatbotMessages.appendChild(messageElement);
    setTimeout(() => {
      scrollToBottomIfNear(); // <-- DIUBAH: Gunakan fungsi kondisional
    }, 100); // Timeout untuk memastikan DOM update
  }

  function typeText(element, text, delay = 25) {
    element.innerHTML = "";
    let i = 0;
    function type() {
      if (i < text.length) {
        element.innerHTML += text[i];
        i++;
        scrollToBottomIfNear(); 
        setTimeout(type, delay);
      }
    }
    type();
  }

  async function getBotResponse(userMessage) {
    const apiUrl = "https://intsys-research.telkomuniversity.ac.id/api/generate";
    const messageElement = document.createElement("div");
    messageElement.classList.add("message", "bot");
    chatbotMessages.appendChild(messageElement);
    animateThinking(messageElement);
    setTimeout(() => {
        scrollToBottomIfNear(); 
    }, 50); // Timeout untuk memastikan DOM update

    try {
      const response = await fetch(apiUrl, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          model: "gemma3:1b",
          prompt: userMessage,
          stream: true,
        }),
      });

      if (!response.ok) {
        stopThinkingAnimation();
        messageElement.textContent = `Error: ${response.status}. Maaf, terjadi masalah saat menghubungi server.`;
        return;
      }

      const reader = response.body.getReader();
      const decoder = new TextDecoder("utf-8");
      let fullMessage = "";
      let hasReceivedAnyResponseData = false;

      while (true) {
        const { value, done } = await reader.read();
        if (done) break;

        const chunk = decoder.decode(value, { stream: true });
        const lines = chunk.split("\n").filter(Boolean);

        for (const line of lines) {
          try {
            const data = JSON.parse(line);
            if (data.response) {
              hasReceivedAnyResponseData = true;
              const newText = data.response.replace(/<\/?think>/g, "");
              fullMessage += newText;
            }
            if (data.error) {
              stopThinkingAnimation();
              console.error("Stream error from model:", data.error);
              messageElement.textContent = `Error dari model: ${data.error}`;
              return;
            }
          } catch (e) {
            console.warn("Gagal mem-parsing JSON dari stream:", line, e);
          }
        }
      }

      if (hasReceivedAnyResponseData) {
        if (fullMessage.trim() !== "") {
          stopThinkingAnimation();
          typeText(messageElement, fullMessage); // typeText akan memanggil scrollToBottomIfNear secara internal
        } else {
          stopThinkingAnimation();
          messageElement.textContent = "Model memberikan respons kosong.";
        }
      } else {
        stopThinkingAnimation();
        messageElement.textContent = "Maaf, tidak ada konten respons yang diterima dari model.";
      }

    } catch (error) {
      stopThinkingAnimation();
      console.error("Error fetching bot response:", error);
      messageElement.textContent = "Maaf, terjadi kesalahan jaringan atau respons tidak valid.";
    }
  }
});