import React, { useState } from "react";
import { loginUser } from "../../application/auth/loginUser";
import { loginWithMicrosoft } from "../../infrastructure/api/auth";

export default function LoginPage() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [error, setError] = useState(null);

    const handleLogin = async (e) => {
        e.preventDefault();
        try {
            const user = await loginUser(email, password);
            alert(`Bienvenido ${user.name}, rol: ${user.role}`);
            // Aquí puedes redirigir según rol
        } catch (err) {
            setError(err.message);
        }
    };

    const handleMicrosoftLogin = () => {
        loginWithMicrosoft(); // Redirige al flujo SSO de Azure
    };

    return (
        <div style={{ display: "flex", justifyContent: "center", marginTop: "50px" }}>
            <form onSubmit={handleLogin} style={{ border: "1px solid #ccc", padding: "20px", borderRadius: "8px" }}>
                <h2>Login</h2>
                <div>
                    <label>Email:</label>
                    <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} required />
                </div>
                <div>
                    <label>Contraseña:</label>
                    <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} required />
                </div>
                {error && <p style={{ color: "red" }}>{error}</p>}
                <button type="submit">Ingresar</button>
                <button type="button" onClick={handleMicrosoftLogin} style={{ marginLeft: "10px" }}>
                    Iniciar con Microsoft
                </button>
            </form>
        </div>
    );
}
