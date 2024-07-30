const { defineConfig } = require('cypress');

module.exports = defineConfig({
	viewportWidth: 1440,
	e2e: {
		baseUrl: 'http://localhost:8888',
	},
});
