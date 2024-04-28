const MAX_PROPERTIES = 11;

const addPropertyButton = document.getElementById('add-property');
const propertiesContainer = document.getElementById('properties-container');

let propertiesCount = document.querySelectorAll('.create-product__item').length;

function addPropertyField() {
  if (propertiesCount >= MAX_PROPERTIES) {
    addPropertyButton.disabled = true;
    addPropertyButton.style.opacity = '0.6';
    addPropertyButton.style.pointerEvents = 'none';
    return;
  }

  propertiesCount++;

  const propertyField = document.createElement('div');
  propertyField.classList.add('create-product__item');

  const propertyNameDiv = document.createElement('div');

  const propertyNameLabel = document.createElement('label');
  propertyNameLabel.classList.add('label');
  propertyNameLabel.textContent = 'Название характеристики:';
  propertyNameDiv.appendChild(propertyNameLabel);

  const propertyNameInput = document.createElement('input');
  propertyNameInput.classList.add('input');
  propertyNameInput.type = 'text';
  propertyNameInput.name = `properties[${propertiesCount}][name]`;
  propertyNameInput.id = `property_name_${propertiesCount}`;
  propertyNameInput.placeholder = 'Введите название';
  propertyNameInput.required = true;
  propertyNameDiv.appendChild(propertyNameInput);

  propertyNameLabel.setAttribute('for', `property_name_${propertiesCount}`);

  const propertyValueDiv = document.createElement('div');

  const propertyValueLabel = document.createElement('label');
  propertyValueLabel.classList.add('label');
  propertyValueLabel.textContent = 'Значение характеристики:';
  propertyValueDiv.appendChild(propertyValueLabel);

  const propertyValueInput = document.createElement('input');
  propertyValueInput.classList.add('input');
  propertyValueInput.type = 'text';
  propertyValueInput.name = `properties[${propertiesCount}][value]`;
  propertyValueInput.id = `property_value_${propertiesCount}`;
  propertyValueInput.placeholder = 'Введите характеристику';
  propertyValueInput.required = true;
  propertyValueDiv.appendChild(propertyValueInput);

  propertyValueLabel.setAttribute('for', `property_value_${propertiesCount}`);

  const removePropertyButton = document.createElement('button');
  removePropertyButton.classList.add('create-product__remove');
  removePropertyButton.textContent = 'Удалить свойство';
  removePropertyButton.type = 'button';
  removePropertyButton.addEventListener('click', removePropertyField);

  propertyField.appendChild(propertyNameDiv);
  propertyField.appendChild(propertyValueDiv);
  propertyField.appendChild(removePropertyButton);

  propertiesContainer.appendChild(propertyField);
  updateRemovePropertyButtons();
}

function removePropertyField(event) {
  const propertyField = event.target.closest('.create-product__item');
  propertyField.remove();
  propertiesCount--;

  if (propertiesCount < MAX_PROPERTIES) {
    addPropertyButton.disabled = false;
    addPropertyButton.style.opacity = '1';
    addPropertyButton.style.pointerEvents = 'auto';
  }
}

function updateRemovePropertyButtons() {
  document.querySelectorAll('.create-product__remove').forEach(button => {
    button.removeEventListener('click', removePropertyField);
    button.addEventListener('click', removePropertyField);
  });
}

addPropertyButton.addEventListener('click', addPropertyField);
updateRemovePropertyButtons();