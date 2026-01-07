// Product Attributes and Variants Management
let selectedAttributes = {};
let attributeValues = {};

document.addEventListener('DOMContentLoaded', function () {
    const attributeSelect = document.getElementById('attributeSelect');

    if (attributeSelect) {
        attributeSelect.addEventListener('change', handleAttributeSelection);
    }
});

function handleAttributeSelection(e) {
    const select = e.target;
    const selectedOptions = Array.from(select.selectedOptions);

    // Clear previous selections
    selectedAttributes = {};
    attributeValues = {};

    // Build selected attributes object
    selectedOptions.forEach(option => {
        selectedAttributes[option.value] = {
            id: option.value,
            name: option.dataset.name
        };
    });

    // Render attribute value inputs
    renderAttributeValueInputs();
}

function renderAttributeValueInputs() {
    const container = document.getElementById('attributeValuesContainer');
    container.innerHTML = '';

    if (Object.keys(selectedAttributes).length === 0) {
        document.getElementById('variantsContainer').style.display = 'none';
        return;
    }

    Object.values(selectedAttributes).forEach(attr => {
        const group = document.createElement('div');
        group.className = 'attribute-value-group';
        group.innerHTML = `
            <label>${attr.name}</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="input-${attr.id}" placeholder="Enter value and press Enter">
                <button class="btn btn-gold" type="button" onclick="addAttributeValue(${attr.id}, '${attr.name}')">
                    <i class="fa-solid fa-plus"></i> Add
                </button>
            </div>
            <div class="attribute-values-input" id="values-${attr.id}"></div>
        `;
        container.appendChild(group);

        // Add enter key listener
        const input = group.querySelector(`#input-${attr.id}`);
        input.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addAttributeValue(attr.id, attr.name);
            }
        });
    });
}

function addAttributeValue(attrId, attrName) {
    const input = document.getElementById(`input-${attrId}`);
    const value = input.value.trim();

    if (!value) return;

    // Initialize array if not exists
    if (!attributeValues[attrId]) {
        attributeValues[attrId] = [];
    }

    // Check for duplicates
    if (attributeValues[attrId].includes(value)) {
        alert('This value already exists!');
        return;
    }

    // Add value
    attributeValues[attrId].push(value);

    // Clear input
    input.value = '';

    // Render value tags
    renderAttributeValueTags(attrId);

    // Generate variants
    generateVariants();

    // Dispatch event
    document.dispatchEvent(new CustomEvent('attributeValueAdded', {
        detail: { attrId, attrName, value }
    }));
}

function renderAttributeValueTags(attrId) {
    const container = document.getElementById(`values-${attrId}`);
    container.innerHTML = '';

    if (!attributeValues[attrId]) return;

    attributeValues[attrId].forEach((value, index) => {
        const tag = document.createElement('div');
        tag.className = 'attribute-value-tag';
        tag.innerHTML = `
            ${value}
            <span class="remove-btn" onclick="removeAttributeValue(${attrId}, ${index}, '${selectedAttributes[attrId].name}')">
                <i class="fa-solid fa-times"></i>
            </span>
        `;
        container.appendChild(tag);
    });
}

function removeAttributeValue(attrId, index, attrName) {
    const value = attributeValues[attrId][index];
    attributeValues[attrId].splice(index, 1);
    renderAttributeValueTags(attrId);
    generateVariants();

    // Dispatch event
    document.dispatchEvent(new CustomEvent('attributeValueRemoved', {
        detail: { attrId, attrName, value }
    }));
}

function generateVariants() {
    // Check if we have any attribute values
    const hasValues = Object.values(attributeValues).some(arr => arr.length > 0);

    if (!hasValues) {
        document.getElementById('variantsContainer').style.display = 'none';
        return;
    }

    document.getElementById('variantsContainer').style.display = 'block';

    // Generate all combinations
    const combinations = generateCombinations();

    // Render variants table
    renderVariantsTable(combinations);
}

function generateCombinations() {
    const attrs = Object.keys(attributeValues).filter(id => attributeValues[id].length > 0);

    if (attrs.length === 0) return [];

    function combine(arrays) {
        if (arrays.length === 0) return [[]];

        const [first, ...rest] = arrays;
        const combos = combine(rest);

        return first.flatMap(value =>
            combos.map(combo => [value, ...combo])
        );
    }

    const valueArrays = attrs.map(attrId => {
        return attributeValues[attrId].map(value => ({
            attrId,
            attrName: selectedAttributes[attrId].name,
            value
        }));
    });

    return combine(valueArrays);
}

function renderVariantsTable(combinations) {
    const tbody = document.getElementById('variantsTableBody');
    tbody.innerHTML = '';

    combinations.forEach((combo, index) => {
        const variantName = combo.map(c => `${c.attrName}: ${c.value}`).join(', ');
        const variantData = JSON.stringify(combo.reduce((acc, c) => {
            acc[c.attrName] = c.value;
            return acc;
        }, {}));

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                ${variantName}
                <input type="hidden" name="variants[${index}][name]" value="${variantName}">
                <input type="hidden" name="variants[${index}][attributes]" value='${variantData}'>
            </td>
            <td>
                <input type="number" step="0.01" name="variants[${index}][price]" class="form-control" placeholder="0.00" required>
            </td>
            <td>
                <input type="number" name="variants[${index}][stock]" class="form-control" placeholder="0" value="0" required>
            </td>
            <td>
                <input type="text" name="variants[${index}][sku]" class="form-control" placeholder="SKU">
            </td>
        `;
        tbody.appendChild(row);
    });
}
