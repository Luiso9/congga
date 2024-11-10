import React from "react";

export default function AdminDashboard() {
	const message = location.state?.message || "Welcome to the Admin Dashboard";
	return (
		<div className="dashboard">
			<h1>Sucessfully Login</h1>
            <p>{message}</p>
		</div>
	);
}
