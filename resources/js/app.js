import './bootstrap.js';
// Başlık değişikliği
document.getElementById("baslik").innerText = "Create CV";

// Form ve elementleri seç
const form = document.querySelector("form");
const errors = document.getElementById("errors");
const submitButton = document.getElementById("submit_btn");

// Submit butonunu başlangıçta devre dışı bırak
submitButton.disabled = true;

// Required alanları kontrol et ve submit butonunu aktif/pasif yap
form.addEventListener("input", function() {
    const allFilled = [...form.querySelectorAll("input[required]:not(#skill_input), textarea[required], select[required]:not(#skill_level)")]
        .every(el => el.value.trim() !== "");
    submitButton.disabled = !allFilled;
});

// Form submit kontrolü
form.addEventListener("submit", function(e) {
    e.preventDefault();
    errors.innerHTML = "";

    const phone = document.getElementById("phone").value.trim();
    const phoneRegex = /^\d{10}$/;

    if(phone === "") {
        errors.innerHTML = "Fill in the phone field!";
        return;
    }


    // Eğer kontroller geçtiyse formu gönder
    form.submit();
});

// Skill ekleme
const addSkillBtn = document.getElementById("add_skill");
const skillInput = document.getElementById("skill_input");
const skillLevel = document.getElementById("skill_level");
const skillList = document.getElementById("skill_list");
const skillsHidden = document.getElementById("skills_hidden");

let skillsArray = [];

addSkillBtn.addEventListener("click", function() {
    const skill = skillInput.value.trim();
    const level = skillLevel.value;

    if(skill === "" || level === "") {
        alert("Please enter skill and level!");
        return;
    }

    // Listeye ekle
    const li = document.createElement("li");
    li.textContent = skill + " (" + level + ")";
    skillList.appendChild(li);

    // Array'e ekle ve hidden input'u düz metin olarak güncelle
    skillsArray.push({skill: skill, level: level});
    const skillsPlainText = skillsArray
        .map(item => `${item.skill} (${item.level}),`)
        .join("\n");
    skillsHidden.value = skillsPlainText;

    // Inputları temizle
    skillInput.value = "";
    skillLevel.value = "";
});
