import { login } from "../../infrastructure/api/auth";

export async function loginUser(email, password) {
    const data = await login(email, password);
    return data.user; // Devuelves el objeto user que viene del backend
}
