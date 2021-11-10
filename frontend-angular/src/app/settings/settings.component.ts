import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';

import { Role, RolesService, UploadFileService, User, UserService } from '../core';
import { Upload } from '../core/models/upload.model';

@Component({
  selector: 'app-settings-page',
  styleUrls: ['./settings.component.css'],
  templateUrl: './settings.component.html'
})
export class SettingsComponent implements OnInit {
  user: User = {} as User;
  settingsForm: FormGroup;
  errors: Object = {};
  isSubmitting = false;
  roles: Array<Role> = [];
  rolesLoaded = false;
  isAdmin = false;
  uploadedImage: Upload;

  constructor(
    private router: Router,
    private userService: UserService,
    private fb: FormBuilder,
    private rolesService: RolesService,
    private uploadFileService: UploadFileService
  ) {
    // create form group using the form builder
    this.settingsForm = this.fb.group({
      image: '',
      username: '',
      bio: '',
      email: '',
      password: '',
      role_id: '',
      file_id: ''
    });
    // Optional: subscribe to changes on the form
    // this.settingsForm.valueChanges.subscribe(values => this.updateUser(values));
  }

  ngOnInit() {
    //this.isAdmin = this.user.role.is_admin;
    this.rolesService.getAll()
      .subscribe(roles => {
        this.roles = roles;
        this.rolesLoaded = true;

        // Make a fresh copy of the current user's object to place in editable form fields
        Object.assign(this.user, this.userService.getCurrentUser());
        this.isAdmin = this.user.role.is_admin;

        // Fill the form
        this.settingsForm.patchValue(this.user);
      });
  }

  logout() {
    this.userService.purgeAuth();
    this.router.navigateByUrl('/');
  }

  submitForm() {
    this.isSubmitting = true;

    // update the model
    this.updateUser(this.settingsForm.value);

    this.userService
      .update(this.user)
      .subscribe(
        updatedUser => this.router.navigateByUrl('/profile/' + updatedUser.username),
        err => {
          this.errors = err;
          this.isSubmitting = false;
        }
      );
  }

  updateUser(values: Object) {
    Object.assign(this.user, values);
  }

  selectFile(event: any) {
    this.uploadFile(event.target.files);
  }

  uploadFile(files: FileList) {
    if (files.length == 0) {
      return
    }
    let file: File = files[0];

    this.uploadFileService.uploadFile("/upload-file", file)
      .subscribe(
        file => {
          this.uploadedImage = file;
          this.user.file_id = this.uploadedImage.id;
          this.settingsForm.patchValue(this.user);
        }
      );
  }

}
