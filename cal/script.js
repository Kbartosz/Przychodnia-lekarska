fetch("get_appointments.php?pesel=" + pesel)
  .then((response) => response.text()) // Pobierz tekst (sprawdź JSON)
  .then((text) => {
    console.log("📜 Odpowiedź PHP:", text); // 🔍 Wyświetl w konsoli
    return JSON.parse(text); // Przekształć na JSON
  })
  .then((data) => {
    let appointmentsDiv = document.getElementById("appointments");
    appointmentsDiv.innerHTML = "";

    if (data.error) {
      alert(data.error);
      return;
    }

    if (!data || data.length === 0) {
      appointmentsDiv.innerHTML = "<p>❌ Brak wizyt do odwołania.</p>";
      return;
    }

    data.forEach((appointment) => {
      let appointmentEl = document.createElement("div");
      appointmentEl.innerHTML = `
                <p>📅 <b>Data:</b> ${appointment.data_wizyty}</p>
                <p>🕒 <b>Godzina:</b> ${appointment.godzina}</p>
                <p>👨‍⚕️ <b>Lekarz:</b> ${appointment.lekarz}</p>
                <button onclick="cancelAppointment(${appointment.id_wizyty})">Odwołaj</button>
                <hr>
            `;
      appointmentsDiv.appendChild(appointmentEl);
    });
  })
  .catch((error) => {
    console.error("❌ Błąd pobierania wizyt:", error);
    alert("❌ Wystąpił błąd przy pobieraniu wizyt.");
  });
