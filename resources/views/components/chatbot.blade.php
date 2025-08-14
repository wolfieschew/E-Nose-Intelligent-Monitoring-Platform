<div id="chatbot-icon">
    <img src="{{ asset('assets/img/robot.png') }}" alt="Chatbot Icon" id="chatbot-toggle" class="" />
</div>


<div id="chatbot-container" class="hidden">
    <div id="chatbot-header">
        <span>Chatbot</span>
        <button id="close-btn">&times;</button>
    </div>
    <div id="chatbot-body">
        <div id="chatbot-messages"></div>
    </div>
    <div id="chatbot-input-container">
        <input type="text" id="chatbot-input" placeholder="Type a message..." />
        <button id="send-btn">Send</button>
    </div>
</div>