elements = [];
openTab = "";
async function getElements(btn) {
  openTab = btn.innerHTML;
  displayLoading(btn.innerHTML);
  try {
    const response = await fetch(
      window.location.origin +
        "/IoCrud.php?request=" +
        btn.innerHTML.toLowerCase().replace(/\s+/g, "")
    );
    elements = await response.json();
  } catch (err) {
    console.log("Une erreur est survenue");
  }
  console.log(elements);
  displayElements(btn.innerHTML, elements);
}

function displayLoading(type) {
  block = document.getElementById("pills-" + type.replace(/\s+/g, ""));
  block.innerHTML = `<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>`;
}

function displayElements(type, content) {
  let block = document.getElementById("pills-" + type.replace(/\s+/g, ""));

  let html = '<div class="table-responsive"><table class="table"><thead><tr>';

  content.forEach((element) => {
    Object.keys(element).forEach((key) => {
      if (!html.includes(key)) {
        html += `<th>${key}</th>`;
      }
    });
  });

  html += '</tr></thead><tbody class="table-group-divider">';

  content.forEach((element) => {
    html += '<tr onclick="generateModal(this)">';
    Object.keys(element).forEach((key) => {
      if (element[key] && typeof element[key] === "object") {
        if (
          Array.isArray(element[key]) &&
          typeof element[key][0] !== "object"
        ) {
          // Handle simple nested arrays
          html += `<td>${element[key].join(", ")}</td>`;
        } else if (Array.isArray(element[key])) {
          // Handle associative arrays
          let arrayString = "";
          element[key].forEach((item) => {
            Object.keys(item).forEach((subkey) => {
              arrayString += `${subkey}: ${item[subkey]}<br>`;
            });
            arrayString += "<br>";
          });
          html += `<td>${arrayString}</td>`;
        } else {
          // Handle nested objects
          let objectString = "";
          Object.keys(element[key]).forEach((subkey) => {
            objectString += `${subkey}: ${element[key][subkey]}<br>`;
          });
          html += `<td>${objectString}</td>`;
        }
      } else {
        html += `<td>${element[key]}</td>`;
      }
    });
    html += "</tr>";
  });

  html += "</tbody></table></div>";

  block.innerHTML = html;
}

function generateModal(element) {
  const myModal = new bootstrap.Modal(
    document.getElementById("staticBackdrop")
  );
  myModal.show();
  const modalHeader = document.getElementById("modal-title");
  const modalBody = document.getElementById("modal-body");
  const modalFooter = document.getElementById("modal-footer");

  // Clear the content of the modalBody and modalFooter
  modalHeader.innerHTML = openTab;
  modalBody.innerHTML = "";
  modalFooter.innerHTML = "";

  const { form, submitButton } = generateForm(
    elements.find((x) => x["id"] == element.firstElementChild.textContent)
  );
  modalBody.appendChild(form);
  modalFooter.appendChild(submitButton);
}

function generateForm(content) {
  const form = document.createElement("form");

  // Function to check if a string is an email
  function isEmail(str) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(str);
  }

  for (const key in content) {
    if (content.hasOwnProperty(key)) {
      const formGroup = document.createElement("div");
      formGroup.classList.add("mb-3");

      const label = document.createElement("label");
      label.htmlFor = key;
      label.textContent = key;
      formGroup.appendChild(label);

      if (key === "admin" || key === "banned") {
        const checkboxContainer = document.createElement("div");
        checkboxContainer.classList.add("form-check");

        const input = document.createElement("input");
        input.type = "checkbox";
        input.classList.add("form-check-input");
        input.name = key;
        input.id = key;
        input.checked = content[key];

        const checkboxLabel = document.createElement("label");
        checkboxLabel.classList.add("form-check-label");
        checkboxLabel.htmlFor = key;
        checkboxLabel.textContent = key;

        checkboxContainer.appendChild(input);
        checkboxContainer.appendChild(checkboxLabel);
        formGroup.appendChild(checkboxContainer);
      } else if (Array.isArray(content[key])) {
        const input = document.createElement("input");
        input.type = "text";
        input.classList.add("form-control");
        input.name = key;
        input.id = key;
        input.value = content[key].join(",");

        formGroup.appendChild(input);
      } else if (content[key] && typeof content[key] === "object") {
        // Handle nested objects
        const input = document.createElement("input");
        input.type = "text";
        input.classList.add("form-control");
        input.name = key;
        input.id = key;
        input.value = JSON.stringify(content[key]);

        formGroup.appendChild(input);
      } else {
        const input = document.createElement("input");
        input.type = isEmail(content[key])
          ? "email"
          : typeof content[key] === "number"
          ? "number"
          : "text";
        input.classList.add("form-control");
        input.name = key;
        input.id = key;
        input.value = content[key];

        if (key === "id") {
          input.readOnly = true;
        }

        formGroup.appendChild(input);
      }

      form.appendChild(formGroup);
    }
  }

  const submitButton = document.createElement("button");
  submitButton.textContent = "Submit";
  submitButton.classList.add("btn", "btn-primary");
  submitButton.type = "button";

  submitButton.addEventListener("click", function (event) {
    event.preventDefault();
    const formData = new FormData(form);
    const updatedContent = {};

    for (const [key, value] of formData.entries()) {
      const input = form.querySelector(`#${key}`);
      let parsedValue = value;

      if (input.type === "text" && /,/.test(value)) {
        const parsedValue = value.trim().split(",");
        updatedContent[key] = parsedValue;
      } else {
        parsedValue =
          input.type === "checkbox"
            ? input.checked
            : isNaN(value)
            ? value
            : parseFloat(value);
        updatedContent[key] = parsedValue;
      }
    }

    if (form.admin) {
      updatedContent["admin"] = form.admin.checked;
    }

    if (form.banned) {
      updatedContent["banned"] = form.banned.checked;
    }

    postData(JSON.stringify(updatedContent));
  });

  return { form, submitButton };
}

async function postData(myArray) {
  console.log(myArray);
  try {
    const response = await fetch(window.location.origin + "/IoCrud.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        operationType: "update",
        entityType: openTab.toLowerCase().replace(/\s+/g, ""),
        entity: myArray,
      }),
    });

    if (!response.ok) {
      throw new Error(`HTTP error ${response.status}`);
    }
    await response.text(response).then((text) => {
      console.log(text);
    });
    const data = await response.json();
    console.log("POST request:", data);
  } catch (err) {
    console.error("POST request failed:", err);
  }
}
