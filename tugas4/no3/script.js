const buku = {
    judul: "Harry Potter and The Philosopher's Stone",
    pengarang: "J. K. Rowling",
    tahun: 1997
  };

  for (let key in buku) {
    console.log(key + " : " + buku[key]);
  }