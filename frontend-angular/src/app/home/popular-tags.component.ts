import { Component, OnInit } from '@angular/core';

import { TagsService } from '../core';

@Component({
  selector: 'app-popular-tags',
  templateUrl: './popular-tags.component.html',
  styleUrls: ['./popular-tags.component.css']
})
export class PopularTagsComponent implements OnInit {
  constructor(
    private tagsService: TagsService
  ) { }

  tags: Array<string> = [];
  tagsLoaded = false;

  ngOnInit() {
    this.tagsService.getAll()
      .subscribe(tags => {
        this.tags = tags;
        this.tagsLoaded = true;
      });
  }
}