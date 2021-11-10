import { Component, OnInit } from '@angular/core';

import { PopularUsersService } from '../core';

@Component({
    selector: 'app-popular-users',
    templateUrl: './popular-users.component.html',
    styleUrls: ['./popular-users.component.css']
})
export class PopularUsersComponent implements OnInit {
    constructor(
        private popularUsersService: PopularUsersService
    ) { }

    users: Array<string> = [];
    usersLoaded = false;

    ngOnInit() {
        this.popularUsersService.getAll()
            .subscribe(users => {
                this.users = users;
                this.usersLoaded = true;
            });
    }
}