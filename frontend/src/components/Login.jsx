import React, { useState } from "react";
import { apiClient } from "../apiClient";
import { useNavigate } from "react-router-dom";

function App() {
	const [email, setEmail] = useState("");
	const [password, setPassword] = useState("");
	const [action, setAction] = useState("login");
	const [message, setMessage] = useState("");
	const navigate = useNavigate();

	const handleLogin = async () => {
		try {
			const response = await apiClient("/controllers/authController.php", {
				method: "POST",
				body: JSON.stringify({
					action: "login",
					emailid: email,
					password: password,
				}),
			});

			if (response.success) {
				setMessage("Login successful");

				if (response.role === "student") {
					navigate("/students/StudentDashboard");
				} else if (response.role === "admin") {
					navigate("/admin/AdminDashboard");
				}
			} else {
				setMessage(response.message || "Login failed");
			}
		} catch (error) {
			setMessage("Error during login. Please try again.");
		}
	};

	return (
		<div className="App">
			<h1>Library Authentication</h1>
			{action === "login" && (
				<div>
					<h2>Login</h2>
					<input
						type="email"
						placeholder="Email"
						value={email}
						onChange={(e) => setEmail(e.target.value)}
					/>
					<input
						type="password"
						placeholder="Password"
						value={password}
						onChange={(e) => setPassword(e.target.value)}
					/>
					<button onClick={handleLogin}>Login</button>
				</div>
			)}

			<p>{message}</p>
		</div>
	);
}

export default App;
