function getElements(btn) {
  async () => {
    try {
      const res = await fetch(
        window.location.origin + "/IoCrud.php?request=" + btn.innerHTML.toLowerCase()
      );
      const elements = await res.json();
      console.table(elements);
    } catch (err) {
      console.log("Une erreur est survenue");
    }
  };
}
