<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Schedule - UiSync</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background: #0d0d0d;
      overflow-x: hidden;
      color: white;
    }

    .hero-section {
      min-height: 100vh;
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9)),
                  url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d');
      background-size: cover;
      background-position: center;
      position: relative;
      padding: 20px;
      display: flex;
    }

    .sidebar {
      width: 90px;
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 20px 0;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
      height: 90vh;
      flex-shrink: 0;
    }

    .UiSync {
      font-weight: bold;
      color: #facc15;
      margin-bottom: 20px;
      text-transform: uppercase;
      font-size: 14px;
      letter-spacing: 0.5px;
      text-align: center;
    }

    .menu {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .menu a {
      text-decoration: none;
    }

    .menu i {
      width: 45px;
      height: 45px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 12px;
      margin: 10px 0;
      background: rgba(255, 255, 255, 0.1);
      color: white;
      transition: 0.3s;
      font-size: 18px;
    }

    .menu a:hover i,
    .menu i.active {
      background: #facc15 !important;
      color: black !important;
      transform: scale(1.05);
    }

    .content {
      flex: 1;
      padding-left: 30px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .event-center {
      text-align: center;
      margin-top: 40px;
      position: relative;
    }

    .event-title {
      font-size: 120px;
      font-weight: 900;
      opacity: 0.05;
      position: absolute;
      top: -40px;
      left: 50%;
      transform: translateX(-50%);
      width: 100%;
      text-align: center;
      letter-spacing: 10px;
      pointer-events: none;
      transition: 0.4s ease-in-out;
    }

    .fighters {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 80px;
      margin-bottom: 30px;
      flex-wrap: wrap;
      position: relative;
      z-index: 2;
    }

    .fighter img {
      width: 260px;
      height: 340px;
      object-fit: cover;
      border-radius: 20px;
      border: 2px solid rgba(250, 204, 21, 0.5);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
      transition: all 0.4s ease-in-out;
    }

    .fighter img:hover {
      transform: scale(1.03);
      border-color: #facc15;
    }

    .vs {
      font-size: 80px;
      font-weight: bold;
      color: #facc15;
      transition: 0.4s ease-in-out;
    }

    .date {
      font-size: 70px;
      font-weight: bold;
      line-height: 1.1;
      transition: 0.4s ease-in-out;
    }

    .date span {
      color: #facc15;
    }

    .location {
      margin-top: 20px;
      color: #d1d5db;
      font-size: 18px;
    }

    .event-days {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
      gap: 20px;
      margin-top: 50px;
    }

    .day-card {
      background: rgba(255, 255, 255, 0.08);
      border-radius: 25px;
      padding: 20px;
      text-align: center;
      transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      backdrop-filter: blur(10px);
      cursor: pointer;
      user-select: none;
      border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .day-card:hover {
      transform: translateY(-10px);
      background: rgba(255, 255, 255, 0.15);
    }

    .day-card.active {
      background: #facc15;
      color: black;
      border-color: #facc15;
      box-shadow: 0 10px 20px rgba(250, 204, 21, 0.2);
    }

    .day-name {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .day-number {
      font-size: 55px;
      font-weight: bold;
      line-height: 1;
    }

    .event-type {
      margin-top: 15px;
      font-size: 14px;
      color: #d1d5db;
    }

    .active .event-type {
      color: black;
      font-weight: 500;
    }

    @media(max-width:1200px) {
      .fighters { gap: 30px; }
      .fighter img { width: 200px; height: 280px; }
      .event-title { font-size: 70px; }
      .date { font-size: 50px; }
    }

    @media(max-width:992px) {
      .hero-section { flex-direction: column; }
      .sidebar { width: 100%; height: auto; flex-direction: row; padding: 15px 20px; margin-bottom: 30px; }
      .UiSync { margin-bottom: 0; width: auto; font-size: 16px; }
      .menu { flex-direction: row; }
      .menu i { margin: 0 5px; }
      .content { padding-left: 0; }
      .event-title { position: relative; top: auto; left: auto; transform: none; font-size: 50px; opacity: 0.1; margin-bottom: 20px; }
    }

    @media(max-width:768px) {
      .fighters { flex-direction: column; gap: 15px; }
      .vs { font-size: 50px; }
      .date { font-size: 40px; }
      .event-title { font-size: 40px; letter-spacing: 4px; }
    }

    @media(max-width:576px) {
      .hero-section { padding: 15px; }
      .sidebar { flex-direction: column; gap: 15px; }
      .menu { flex-wrap: wrap; justify-content: center; }
      .date { font-size: 30px; }
      .day-number { font-size: 40px; }
    }

    footer {
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      padding: 15px 0 0 0;
      margin-top: 20px;
      text-align: center;
      font-size: 13px;
    }
  </style>
</head>

<body>

  <div class="hero-section">
    <nav class="sidebar">
      <div>
        <div class="UiSync">UiSync</div>
        <div class="menu">
          <a href="dashboard.php" title="Dashboard">
            <i class="bi bi-house-fill"></i>
          </a>
          <a href="event.php" title="Upcoming Events">
            <i class="bi bi-calendar-event-fill active"></i>
          </a>
          <a href="participants.php" title="Participants">
            <i class="bi bi-people-fill"></i>
          </a>
        </div>
      </div>

      <div class="menu">
        <a href="#" onclick="logout()" title="Logout">
          <i class="bi bi-box-arrow-right"></i>
        </a>
      </div>
    </nav>

    <main class="content">
      <div class="event-center">
        <div class="event-title" id="bg-title">UI/UX WORKSHOP</div>

        <div class="fighters">
          <div class="fighter">
            <img id="img-left" src="pic7.jpg" alt="Speaker 1" onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400'">
          </div>
          <div class="vs" id="vs-divider">AND</div>
          <div class="fighter">
            <img id="img-right" src="pic8.jpg" alt="Speaker 2" onerror="this.src='https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400'">
          </div>
        </div>

        <div class="date" id="event-date-display">
          14 SEP 2026 <br>
          <span>09:00 UTC</span>
        </div>

        <div class="location">
          <i class="bi bi-geo-alt text-warning me-2"></i>UiTM Convention Hall, Malaysia
        </div>
      </div>

      <div class="event-days">
        <div class="day-card active" data-day="0">
          <div class="day-name">MO</div>
          <div class="day-number">14</div>
          <div class="event-type">Workshop</div>
        </div>

        <div class="day-card" data-day="1">
          <div class="day-name">TU</div>
          <div class="day-number">15</div>
          <div class="event-type">Seminar</div>
        </div>

        <div class="day-card" data-day="2">
          <div class="day-name">WE</div>
          <div class="day-number">16</div>
          <div class="event-type">Main Event</div>
        </div>

        <div class="day-card" data-day="3">
          <div class="day-name">TH</div>
          <div class="day-number">17</div>
          <div class="event-type">Closing</div>
        </div>
      </div>
      
      <footer class="text-secondary">
        <p class="m-0">&copy; 2026 UiSync Event Tracker System. All Rights Reserved to Nur Athirah Fadhlin Mat Nawi.</p>
        <small>IMS566 Advanced Web Design Development & Content Management</small>
      </footer>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const eventData = [
      {
        title: "UI/UX WORKSHOP",
        imgLeft: "pic7.jpg", 
        imgRight: "pic8.jpg",
        imgLeftFallback: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400",
        imgRightFallback: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400",
        showVs: "AND",
        dateHtml: "14 SEP 2026 <br><span>09:00 UTC</span>"
      },
      {
        title: "DEV SEMINAR",
        imgLeft: "pic10.jpg",
        imgRight: "pic13.jpg",
        imgLeftFallback: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400",
        imgRightFallback: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400",
        showVs: "WITH",
        dateHtml: "15 SEP 2026 <br><span>14:00 UTC</span>"
      },
      {
        title: "TECH EXPO 2026",
        imgLeft: "pic3.jpg",
        imgRight: "pic5.jpg",
        imgLeftFallback: "https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400",
        imgRightFallback: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400",
        showVs: "VS",
        dateHtml: "16 SEP 2026 <br><span>19:00 UTC</span>"
      },
      {
        title: "CLOSING CEREMONY",
        imgLeft: "pic14.jpg",
        imgRight: "pic15.jpg",
        imgLeftFallback: "https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400",
        imgRightFallback: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400",
        showVs: "DONE",
        dateHtml: "17 SEP 2026 <br><span>17:00 UTC</span>"
      }
    ];

    const bgTitle = document.getElementById('bg-title');
    const imgLeft = document.getElementById('img-left');
    const imgRight = document.getElementById('img-right');
    const vsDivider = document.getElementById('vs-divider');
    const dateDisplay = document.getElementById('event-date-display');
    const cards = document.querySelectorAll('.day-card');

    cards.forEach(card => {
      card.addEventListener('click', () => {
        cards.forEach(c => c.classList.remove('active'));
        card.classList.add('active');
        
        const index = card.getAttribute('data-day');
        const selected = eventData[index];
        
        bgTitle.textContent = selected.title;
        
        imgLeft.src = selected.imgLeft;
        imgLeft.onerror = function() { this.src = selected.imgLeftFallback; };
        
        imgRight.src = selected.imgRight;
        imgRight.onerror = function() { this.src = selected.imgRightFallback; };
        
        vsDivider.textContent = selected.showVs;
        dateDisplay.innerHTML = selected.dateHtml;
      });
    });

    
    document.querySelector('.day-card[data-day="0"]').click();

    function logout() {
      if (confirm("Are you sure you want to logout?")) {
        alert("Logout Successful");
        window.location.href = "index.html";
      }
    }
  </script>
</body>

</html>