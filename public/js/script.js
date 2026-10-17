document.addEventListener("DOMContentLoaded", () => {
    // 1. Cargar estadísticas si existen los elementos en index.html
    if (document.getElementById("counter-voluntarios")) {
        fetch("/api/resumen.php")
            .then(res => res.json())
            .then(data => {
                document.getElementById("counter-voluntarios").textContent = data.voluntarios || 0;
                document.getElementById("counter-refugios").textContent = data.refugios || 0;
                document.getElementById("counter-pedidos").textContent = data.pedidos || 0;
            })
            .catch(() => console.error("Error cargando resumen"));
    }

    // 2. Cargar lista de refugios
    const listaRefugios = document.getElementById("lista-refugios");
    if (listaRefugios) {
        fetch("/api/refugios.php")
            .then(res => res.json())
            .then(data => {
                if (!data.length) {
                    listaRefugios.innerHTML = "<p>No hay refugios cargados actualmente.</p>";
                    return;
                }
                listaRefugios.innerHTML = data.map(r => `
                    <div style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 4px;">
                        <strong>${r.nombre}</strong><br>
                        <span>Dirección: ${r.ubicacion || r.direccion}</span><br>
                        <span>Capacidad: ${r.capacidad || 'No especificada'}</span>
                    </div>
                `).join("");
            })
            .catch(() => listaRefugios.innerHTML = "<p>Error al cargar refugios.</p>");
    }

    // 3. Manejo del formulario de Ayuda
    const formAyuda = document.getElementById("form-ayuda");
    if (formAyuda) {
        formAyuda.addEventListener("submit", async (e) => {
            e.preventDefault();
            const formData = new FormData(formAyuda);
            const data = Object.fromEntries(formData.entries());
            const msg = document.getElementById("msg-ayuda");

            try {
                const res = await fetch("/api/solicitudes.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(data)
                });
                if (res.ok) {
                    msg.style.color = "green";
                    msg.textContent = "¡Solicitud enviada con éxito! Nos comunicaremos pronto.";
                    formAyuda.reset();
                } else {
                    throw new Error();
                }
            } catch {
                msg.style.color = "red";
                msg.textContent = "Error al enviar la solicitud. Intentá nuevamente.";
            }
        });
    }

    // 4. Manejo del formulario de Donaciones / Colaboraciones
    const formDonar = document.getElementById("form-donar");
    if (formDonar) {
        formDonar.addEventListener("submit", async (e) => {
            e.preventDefault();
            const formData = new FormData(formDonar);
            const data = Object.fromEntries(formData.entries());
            const msg = document.getElementById("msg-donar");

            try {
                const res = await fetch("/api/donaciones.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(data)
                });
                if (res.ok) {
                    msg.style.color = "green";
                    msg.textContent = "¡Gracias por tu colaboración! Registrada con éxito.";
                    formDonar.reset();
                } else {
                    throw new Error();
                }
            } catch {
                msg.style.color = "red";
                msg.textContent = "Error al registrar la ayuda. Intentá nuevamente.";
            }
        });
    }

    // 5. Panel Admin: Cargar tablas si estamos en admin.html
    const tablaSolicitudes = document.getElementById("tabla-solicitudes");
    if (tablaSolicitudes) {
        fetch("/api/solicitudes.php")
            .then(res => res.json())
            .then(data => {
                if (!data.length) {
                    tablaSolicitudes.innerHTML = "<p>No hay solicitudes pendientes.</p>";
                    return;
                }
                tablaSolicitudes.innerHTML = `
                    <table>
                        <tr><th>Nombre</th><th>Teléfono</th><th>Tipo</th><th>Ubicación</th></tr>
                        ${data.map(s => `<tr><td>${s.nombre}</td><td>${s.telefono}</td><td>${s.tipo_ayuda}</td><td>${s.ubicacion}</td></tr>`).join("")}
                    </table>
                `;
            });
    }

    const tablaDonaciones = document.getElementById("tabla-donaciones");
    if (tablaDonaciones) {
        fetch("/api/donaciones.php")
            .then(res => res.json())
            .then(data => {
                if (!data.length) {
                    tablaDonaciones.innerHTML = "<p>No hay colaboradores registrados.</p>";
                    return;
                }
                tablaDonaciones.innerHTML = `
                    <table>
                        <tr><th>Nombre</th><th>Teléfono</th><th>Aporte</th></tr>
                        ${data.map(d => `<tr><td>${d.nombre}</td><td>${d.telefono}</td><td>${d.tipo}</td></tr>`).join("")}
                    </table>
                `;
            });
    }
});