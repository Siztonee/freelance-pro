$(document).ready(function(){
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            cache: false // Добавляем эту строку, чтобы отключить кэширование
        }
    });

    let selectedSkills = [];

    $('.specialization-link').on('click', function(e) {
        e.preventDefault();
        var specializationId = $(this).data('id');

        $.ajax({
            url: '/search-freelancer',
            method: 'POST',
            data: { category_id: specializationId },
            success: function(data) {
                var skillsContainer = $('#skills-container');
                var skillsList = $('#skills-list');
                skillsList.empty();

                data.skills.forEach(function(skill) {
                    var skillTag = `
                        <a href="#" wire:click.prevent="searchBySkills(${skill.name})" class="bg-green-100 hover:bg-green-200 text-green-800 text-sm font-medium px-3 py-1 rounded-full skill-link" data-id="${skill.id}">
                            ${skill.name}
                        </a>
                    `;
                    skillsList.append(skillTag);
                });

                skillsContainer.show();
            }
        });
    });

    $(document).on('click', '.skill-link', function(e) {
        e.preventDefault();
        var skillId = $(this).data('id');
        var skillName = $(this).text();

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected bg-blue-200').addClass('bg-green-100');
            selectedSkills = selectedSkills.filter(function(skill) {
                return skill.id !== skillId;
            });
        } else {
            $(this).removeClass('bg-green-100').addClass('selected bg-blue-200');
            selectedSkills.push({ id: skillId, name: skillName });
        }

        updateSelectedSkills();
    });

    $(document).on('click', '.selected-skill', function(e) {
        e.preventDefault();
        var skillId = $(this).data('id');

        selectedSkills = selectedSkills.filter(function(skill) {
            return skill.id !== skillId;
        });

        updateSelectedSkills();

        $(`.skill-link[data-id="${skillId}"]`).removeClass('selected bg-blue-200').addClass('bg-green-100');
    });

    function updateSelectedSkills() {
        var selectedSkillsContainer = $('#selected-skills-container');
        var selectedSkillsList = $('#selected-skills-list');
        selectedSkillsList.empty();

        if (selectedSkills.length > 0) {
            selectedSkills.forEach(function(skill) {
                var skillTag = `
                    <a href="#" class="bg-blue-200 text-blue-800 text-sm font-medium px-3 py-1 rounded-full selected-skill" data-id="${skill.id}">
                        ${skill.name}
                    </a>
                `;
                selectedSkillsList.append(skillTag);
            });

            selectedSkillsContainer.show();
        } else {
            selectedSkillsContainer.hide();
        }
    }
});
