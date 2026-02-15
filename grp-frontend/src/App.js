import React, { useEffect, useState } from "react";
import "./styles/App.css";
import LoginPage from "./interfaces/auth/LoginPage";

function App() {
  const [isAuthenticated, setIsAuthenticated] = useState(false);

  useEffect(() => {
    // Revisar si ya existe token en localStorage
    const token = localStorage.getItem("token");
    if (token) {
      setIsAuthenticated(true);
    }
  }, []);

  return (
      <div className="App">
        {isAuthenticated ? (
            <h1>Bienvenido al sistema GRP</h1>
        ) : (
            <LoginPage />
        )}
      </div>
  );
}

export default App;
