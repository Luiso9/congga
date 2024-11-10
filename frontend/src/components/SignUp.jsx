import React, { useState } from "react";
import axios from "axios";

function Signup() {
	const [formData, setFormData] = useState({
		fullname: "",
		mobileno: "",
		email: "",
		password: "",
	});
	const [message, setMessage] = useState("");

	const handleChange = (e) => {
		const { name, value } = e.target;
		setFormData({ ...formData, [name]: value });
	};

	const handleSubmit = async (e) => {
		e.preventDefault();
		setMessage(""); // Clear previous message

		try {
			const response = await axios.post(
				"http://localhost/bloom/backend/controllers/SignUp.php",
				formData
			);

			if (response.data.success) {
				setMessage(response.data.message);
			} else {
				setMessage(response.data.message);
			}
		} catch (error) {
			console.error("Error:", error);
			setMessage("An error occurred. Please try again.");
		}
	};

	return (
		<div>
			<h2>Signup</h2>
			{message && <p>{message}</p>}
			<form onSubmit={handleSubmit}>
				<div>
					<label>Full Name:</label>
					<input
						type="text"
						name="fullname"
						value={formData.fullname}
						onChange={handleChange}
						required
					/>
				</div>
				<div>
					<label>Mobile Number:</label>
					<input
						type="text"
						name="mobileno"
						value={formData.mobileno}
						onChange={handleChange}
						required
					/>
				</div>
				<div>
					<label>Email:</label>
					<input
						type="email"
						name="email"
						value={formData.email}
						onChange={handleChange}
						required
					/>
				</div>
				<div>
					<label>Password:</label>
					<input
						type="password"
						name="password"
						value={formData.password}
						onChange={handleChange}
						required
					/>
				</div>
				<button type="submit">Sign Up</button>
			</form>
		</div>
	);
}

export default Signup;
