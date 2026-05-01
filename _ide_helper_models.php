<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $file_number
 * @property string|null $jurisdictional_body
 * @property string|null $judge
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property string|null $subject
 * @property string|null $procedural_stage
 * @property string|null $location
 * @property string|null $sumilla
 * @property string|null $judicial_district
 * @property string|null $legal_specialist
 * @property string|null $process
 * @property string|null $specialty
 * @property string|null $status
 * @property string|null $completion_date
 * @property string|null $reason_conclusion
 * @property int $lawyer_id
 * @property int $customer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Customer|null $customer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Folder> $folders
 * @property-read int|null $folders_count
 * @property-read \App\Models\User|null $lawyer
 * @method static \Database\Factories\CaseModelFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereCompletionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereFileNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereJudge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereJudicialDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereJurisdictionalBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereLawyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereLegalSpecialist($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereProceduralStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereProcess($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereReasonConclusion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereSpecialty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereSumilla($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaseModel withoutTrashed()
 * @mixin \Eloquent
 */
	class CaseModel extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $document_type
 * @property string $document_number
 * @property string|null $business_name
 * @property string|null $first_names
 * @property string|null $paternal_surname
 * @property string|null $maternal_surname
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $home_address
 * @property string|null $district_address
 * @property string|null $province_address
 * @property string|null $department_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CaseModel> $cases
 * @property-read int|null $cases_count
 * @method static \Database\Factories\CustomerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereBusinessName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereDepartmentAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereDistrictAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereDocumentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereDocumentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereFirstNames($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereHomeAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereMaternalSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer wherePaternalSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereProvinceAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer withoutTrashed()
 * @mixin \Eloquent
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $path
 * @property string|null $mime_type
 * @property string|null $extension
 * @property int|null $size
 * @property int $uploaded_by
 * @property int $folder_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Folder|null $folder
 * @property-read \App\Models\User|null $uploator
 * @method static \Database\Factories\FileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereFolderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereUploadedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File withoutTrashed()
 * @mixin \Eloquent
 */
	class File extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property int $case_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\File> $files
 * @property-read int|null $files_count
 * @property-read Folder|null $folder
 * @property-read \App\Models\CaseModel|null $numberCase
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Folder> $subFolders
 * @property-read int|null $sub_folders_count
 * @method static \Database\Factories\FolderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Folder withoutTrashed()
 * @mixin \Eloquent
 */
	class Folder extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $parent_id
 * @property int $level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $lawyers
 * @property-read int|null $lawyers_count
 * @property-read Specialty|null $mainBranch
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Specialty> $secondaryBranches
 * @property-read int|null $secondary_branches_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty withoutTrashed()
 * @mixin \Eloquent
 */
	class Specialty extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $document_type
 * @property string $document_number
 * @property string $first_names
 * @property string $paternal_surname
 * @property string $maternal_surname
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property string|null $profile_photo
 * @property string $role
 * @property string|null $tuition_number
 * @property int|null $lawyer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CaseModel> $cases
 * @property-read int|null $cases_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\File> $files
 * @property-read int|null $files_count
 * @property-read User|null $lawyer
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $secretaries
 * @property-read int|null $secretaries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Specialty> $specialties
 * @property-read int|null $specialties_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDocumentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDocumentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstNames($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLawyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereMaternalSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePaternalSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProfilePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTuitionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 * @mixin \Eloquent
 */
	class User extends \Eloquent implements \PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject {}
}

