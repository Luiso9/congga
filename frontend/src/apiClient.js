import { apiURL } from "./api/apiConfig";

export const apiClient = (endpoint, options = {}) => {
  const method = options.method || 'GET';

  if (method === 'POST' && options.body) {
    options.headers = {
      ...options.headers,
      'Content-Type': 'application/json',
    };
  }

  return fetch(`${apiURL}${endpoint}`, options)
    .then(response => response.json())
    .catch(error => {
      console.error('API Request Error:', error);
      throw error; // Propagate error
    });
};
