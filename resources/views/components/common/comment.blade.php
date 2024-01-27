<section class="shadow rounded-lg p-4 items-start bg-white">
  <header class="flex items-start space-x-3 mb-2">
    <img class="rounded-full w-10 h-10" src="https://media.licdn.com/dms/image/C4E03AQFog-dpZdNi4A/profile-displayphoto-shrink_800_800/0/1583457495504?e=2147483647&v=beta&t=13hretZCXqnp8e-D-ftcNRABqF7XXdEHP6ZyX5D1QUo" alt="">
    <div>
      <a href="#" class="font-medium text-base inline-block">
        {{ $comment->user->username }}
      </a>
      <div class="text-xs text-black-500">
        {{ $comment->created_at->diffForHumans() }}
      </div>
    </div>
  </header>
  <div>
    <p class="text-xs">
      {{ $comment->body }}
    </p>
  </div>
</section>
