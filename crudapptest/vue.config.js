module.exports = {
    baseUrl: process.env.NODE_ENV === 'production'
      ? 'http://localhost/VueCrudDist/' //note you can add your own name here
      : '/'
  }